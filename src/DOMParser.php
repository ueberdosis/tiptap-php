<?php declare(strict_types=1);

namespace Tiptap;

use DOMDocument;
use DOMElement;
use DOMNode;
use Exception;
use Tiptap\Core\Mark;
use Tiptap\Core\Node;
use Tiptap\Nodes\Text;
use Tiptap\Utils\InlineStyle;

class DOMParser
{
    protected DOMDocument $document;

    protected Schema $schema;

    protected array $storedMarks = [];

    public function __construct(Schema $schema)
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

    private function setDocument(string $value)
    {
        libxml_use_internal_errors(true);

        $this->document = new DOMDocument;
        $this->document->loadHTML(
            $this->wrapHtmlDocument(
                $this->stripWhitespace($value)
            )
        );
    }

    private function wrapHtmlDocument(string $value): string
    {
        return '<?xml encoding="utf-8" ?>' . $value;
    }

    private function stripWhitespace(string $value): string
    {
        return (new Minify)->process($value);
    }

    private function getDocumentBody(): DOMNode
    {
        return $this->document->getElementsByTagName('body')->item(0);
    }

    private function renderChildren(DOMNode $node): array
    {
        $nodes = [];

        /** @var DOMNode $child */
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

                if (is_subclass_of($class, Node::class) && $wrapper = $class::wrapper($child)) {
                    $item['content'] = [
                        array_merge($wrapper, [
                            'content' => @$item['content'] ?: [],
                        ]),
                    ];
                }

                $nodes[] = $item;
            } elseif ($class = $this->getMatchingMark($child)) {
                $item = $this->parseAttributes($class, $child);
                if ($item !== null) {
                    $this->storedMarks[] = $this->parseAttributes($class, $child);
                }

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

    /**
     * @return false|Mark|Node
     */
    private function getMatchingNode(DOMNode $item)
    {
        return $this->getMatchingClass($item, $this->schema->nodes);
    }

    /**
     * @return false|Mark|Node
     */
    private function getMatchingMark(DOMNode $item)
    {
        return $this->getMatchingClass($item, $this->schema->marks);
    }

    /**
     * @return false|Mark|Node
     */
    private function getMatchingClass(DOMNode $node, array $classes)
    {
        foreach ($classes as $class) {
            if ($this->checkParseRules($class->parseHTML($node), $node)) {
                return $class;
            }
        }

        return false;
    }

    private function checkParseRules($parseRules, DOMNode $DOMNode): bool
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

    /**
     * @param DOMElement|DOMNode $DOMNode
     * @throws Exception
     */
    private function checkParseRule(array $parseRule, DOMNode $DOMNode): bool
    {
        // ['tag' => 'span[type="mention"]']
        if (isset($parseRule['tag'])) {
            if (preg_match('/([a-z-]*)\[([a-z-]+)(="([a-z]*)")?\]$/', $parseRule['tag'], $matches)) {
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

            // TODO this if statement always return false this should have a fix
            if (isset($attribute) && ! $DOMNode->hasAttribute($attribute)) {
                if (isset($value) && $DOMNode->getAttribute($attribute) !== $value) {
                    return false;
                }

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

        if (! count($parseRule)
            || (
                ! isset($parseRule['tag'])
                && ! isset($parseRule['style'])
                && ! isset($parseRule['getAttrs'])
            )) {
            return false;
        }

        return true;
    }

    /**
     * @param Mark|Node $class
     * @param DOMElement|DOMNode $DOMNode
     * @throws Exception
     */
    private function parseAttributes($class, DOMNode $DOMNode): ?array
    {
        // TODO: I want to remove ::data
        $item = [
            'type' => $class::$name,
        ];

        if ($class::$name === Text::$name) {
            $text = ltrim($DOMNode->nodeValue, "\n");

            if ($text === '') {
                return null;
            }

            $item = array_merge($item, [
                'text' => $text,
            ]);
        }

        $parseRules = $class->parseHTML();

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

        if (method_exists($class, 'addAttributes')) {
            foreach ($class->addAttributes() as $attribute => $configuration) {
                $value = null;

                if (isset($configuration['parseHTML'])) {
                    $value = $configuration['parseHTML']($DOMNode);
                } elseif ($DOMNode instanceof DOMElement) {
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
