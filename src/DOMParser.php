<?php

namespace Tiptap;

use DOMDocument;
use DOMElement;
use Tiptap\Utils\InlineStyle;

class DOMParser
{
    protected $document;

    protected $schema;

    protected $storedMarks = [];

    public function __construct($schema)
    {
        $this->schema = $schema;
    }

    public function render(string $value): array
    {
        $this->setDocument($value);

        $content = $this->renderChildren(
            $this->getDocumentBody()
        );

        return [
            'type' => 'doc',
            'content' => $content,
        ];
    }

    private function setDocument(string $value): DOMParser
    {
        libxml_use_internal_errors(true);

        $this->document = new DOMDocument;
        $this->document->loadHTML(
            $this->wrapHtmlDocument(
                $this->stripWhitespace($value)
            )
        );

        return $this;
    }

    private function wrapHtmlDocument($value)
    {
        return '<?xml encoding="utf-8" ?>' . $value;
    }

    private function stripWhitespace(string $value): string
    {
        return (new Minify)->process($value);
    }

    private function getDocumentBody(): DOMElement
    {
        return $this->document->getElementsByTagName('body')->item(0);
    }

    private function renderChildren($node): array
    {
        $nodes = [];

        foreach ($node->childNodes as $child) {
            if ($class = $this->getMatchingNode($child)) {
                $item = $this->parseAttributes($class, $child);

                if ($item === null) {
                    if ($child->hasChildNodes()) {
                        $nodes = array_merge($nodes, $this->renderChildren($child));
                    }

                    continue;
                }

                if ($child->hasChildNodes()) {
                    $item = array_merge($item, [
                        'content' => $this->renderChildren($child),
                    ]);
                }

                if (count($this->storedMarks)) {
                    $item = array_merge($item, [
                        'marks' => $this->storedMarks,
                    ]);
                }

                if ($wrapper = $class::wrapper($child)) {
                    $item['content'] = [
                        array_merge($wrapper, [
                            'content' => @$item['content'] ?: [],
                        ]),
                    ];
                }

                array_push($nodes, $item);
            } elseif ($class = $this->getMatchingMark($child)) {
                array_push($this->storedMarks, $this->parseAttributes($class, $child));

                if ($child->hasChildNodes()) {
                    $nodes = array_merge($nodes, $this->renderChildren($child));
                }

                array_pop($this->storedMarks);
            } elseif ($child->hasChildNodes()) {
                $nodes = array_merge($nodes, $this->renderChildren($child));
            }
        }


        // If similar nodes, just with different text follow each other,
        // we can merge them into a single node.
        $mergedNodes = [];

        /**
         * @psalm-suppress UnusedFunctionCall
         */
        array_reduce($nodes, function ($carry, $node) use (&$mergedNodes) {
            // Ignore multidimensional arrays
            if (
                count($node) !== count($node, COUNT_RECURSIVE)
                || count($carry) !== count($carry, COUNT_RECURSIVE)
            ) {
                $mergedNodes[] = $node;

                return $node;
            }

            // Check if text is the only difference
            $differentKeys = array_keys(array_diff($carry, $node));
            if ($differentKeys != ['text']) {
                $mergedNodes[] = $node;

                return $node;
            }

            // Merge it!
            $mergedNodes[count($mergedNodes) - 1]['text'] .= $node['text'];

            return $mergedNodes[count($mergedNodes) - 1];
        }, []);

        return $mergedNodes;
    }

    private function getMatchingNode($item)
    {
        return $this->getMatchingClass($item, $this->schema->nodes);
    }

    private function getMatchingMark($item)
    {
        return $this->getMatchingClass($item, $this->schema->marks);
    }

    private function getMatchingClass($node, $classes)
    {
        foreach ($classes as $class) {
            if ($this->checkParseRules($class->parseHTML($node), $node)) {
                return $class;
            }
        }

        return false;
    }

    private function checkParseRules($parseRules, $DOMNode)
    {
        // TODO: Can we throw this away?
        // if (is_bool($parseRules)) {
        //     return $parseRules;
        // }

        if (is_array($parseRules)) {
            foreach ($parseRules as $parseRule) {
                if (! $this->checkParseRule($parseRule, $DOMNode)) {
                    continue;
                }

                return true;
            }
        }

        return false;
    }

    private function checkParseRule($parseRule, $DOMNode)
    {
        // ['tag' => 'span[type="mention"]']
        if (isset($parseRule['tag'])) {
            if (preg_match('/([a-z-]*)\[([a-z-]+)(="([a-zA-Z]*)")?\]$/', $parseRule['tag'], $matches)) {
                $tag = $matches[1];
                $attribute = $matches[2];
                if (isset($matches[4])) {
                    $value = $matches[4];
                }
            } else {
                $tag = $parseRule['tag'];
            }

            if ($tag !== $DOMNode->nodeName) {
                return false;
            }

            if (isset($attribute) && ! $DOMNode->hasAttribute($attribute)) {
                return false;
            }

            if (isset($value) && $DOMNode->getAttribute($attribute) !== $value) {
                return false;
            }
        }

        // ['style' => 'font-weight']
        if (isset($parseRule['style'])) {
            if (! InlineStyle::hasAttribute($DOMNode, $parseRule['style'])) {
                return false;
            }
        }

        // ['getAttrs' => function($DOMNode) { … }]
        if (isset($parseRule['getAttrs'])) {
            if (isset($parseRule['style']) && InlineStyle::hasAttribute($DOMNode, $parseRule['style'])) {
                $parameter = InlineStyle::getAttribute($DOMNode, $parseRule['style']);
            } else {
                $parameter = $DOMNode;
            }

            if ($parseRule['getAttrs']($parameter) === false) {
                return false;
            }
        }

        if (
            ! is_array($parseRule)
            || ! count($parseRule)
            || (
                ! isset($parseRule['tag'])
                && ! isset($parseRule['style'])
                && ! isset($parseRule['getAttrs'])
            )) {
            return false;
        }

        return true;
    }

    private function parseAttributes($class, $DOMNode)
    {
        // TODO: I want to remove ::data
        $item = [
            'type' => $class::$name,
        ];

        if ($class::$name === 'text') {
            $text = ltrim($DOMNode->nodeValue, "\n");

            if ($text === '') {
                return null;
            }

            $item = array_merge($item, [
                'text' => $text,
            ]);
        }

        $parseRules = $class->parseHTML();

        if (! is_array($parseRules)) {
            return $item;
        }

        foreach ($parseRules as $parseRule) {
            if (! $this->checkParseRule($parseRule, $DOMNode)) {
                continue;
            }

            $attributes = $parseRule['attrs'] ?? [];
            if (count($attributes)) {
                if (! isset($item['attrs'])) {
                    $item['attrs'] = [];
                }

                $item['attrs'] = array_merge($item['attrs'], $attributes);
            }

            if (isset($parseRule['getAttrs'])) {
                if (isset($parseRule['style']) && InlineStyle::hasAttribute($DOMNode, $parseRule['style'])) {
                    $parameter = InlineStyle::getAttribute($DOMNode, $parseRule['style']);
                } else {
                    $parameter = $DOMNode;
                }

                $attributes = $parseRule['getAttrs']($parameter);

                if (! is_array($attributes)) {
                    continue;
                }

                if (! isset($item['attrs'])) {
                    $item['attrs'] = [];
                }

                $item['attrs'] = array_merge($item['attrs'], $attributes);
            }
        }

        /**
         * public function addAttributes()
         * {
         *     return [
         *         'href' => [
         *             'parseHTML' => function ($DOMNode) {
         *                 $attrs['href'] = $DOMNode->getAttribute('href');
         *             }
         *         ],
         *     ];
         * }
         */
        if (method_exists($class, 'addAttributes')) {
            foreach ($class->addAttributes() as $attribute => $configuration) {
                if (isset($configuration['parseHTML'])) {
                    $value = $configuration['parseHTML']($DOMNode);
                } else {
                    $value = $DOMNode->getAttribute($attribute) ?: null;
                }

                if ($value !== null) {
                    $item['attrs'][$attribute] = $value;
                }
            }
        }

        return $item;
    }
}
