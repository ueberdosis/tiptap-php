<?php

namespace Tiptap;

use DOMDocument;
use stdClass;
use Tiptap\Utils\HTML;

class DOMSerializer
{
    protected $document;

    protected $schema;

    public function __construct($schema)
    {
        $this->schema = $schema;
    }

    private function renderNode($node, $previousNode = null, $nextNode = null): string
    {
        $html = [];

        if (isset($node->marks)) {
            foreach ($node->marks as $mark) {
                foreach ($this->schema->marks as $class) {
                    $renderClass = $class;

                    if (! $this->isMarkOrNode($mark, $renderClass)) {
                        continue;
                    }

                    if (! $this->markShouldOpen($mark, $previousNode)) {
                        continue;
                    }

                    $html[] = $this->renderOpeningTag($renderClass, $mark);
                }
            }
        }

        foreach ($this->schema->nodes as $extension) {
            if (! $this->isMarkOrNode($node, $extension)) {
                continue;
            }

            $html[] = $this->renderOpeningTag($extension, $node);

            break;
        }

        // ["content" => …]
        $lastElement = $html[array_key_last($html)] ?? null;
        if (isset($lastElement['content'])) {
            $html[array_key_last($html)] = $lastElement['content'];
        }
        // child nodes
        elseif (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $previousNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                $html[] = $this->renderNode($nestedNode, $previousNestedNode, $nextNestedNode);
            }
        }
        // text
        elseif (isset($node->text)) {
            $html[] = htmlspecialchars($node->text, ENT_QUOTES, 'UTF-8');
        }

        foreach ($this->schema->nodes as $extension) {
            if (! $this->isMarkOrNode($node, $extension)) {
                continue;
            }

            $html[] = $this->renderClosingTag($extension->renderHTML($node));
        }

        if (isset($node->marks)) {
            foreach (array_reverse($node->marks) as $mark) {
                foreach ($this->schema->marks as $extension) {
                    if (! $this->isMarkOrNode($mark, $extension)) {
                        continue;
                    }

                    if (! $this->markShouldClose($mark, $nextNode)) {
                        continue;
                    }

                    $html[] = $this->renderClosingTag($extension->renderHTML($mark));
                }
            }
        }

        return join($html);
    }

    private function isMarkOrNode($markOrNode, $renderClass): bool
    {
        return isset($markOrNode->type) && $markOrNode->type === $renderClass::$name;
    }

    private function markShouldOpen($mark, $previousNode)
    {
        return $this->nodeHasMark($previousNode, $mark);
    }

    private function markShouldClose($mark, $nextNode)
    {
        return $this->nodeHasMark($nextNode, $mark);
    }

    private function nodeHasMark($node, $mark)
    {
        if (! $node) {
            return true;
        }

        if (! property_exists($node, 'marks')) {
            return true;
        }

        // The other node has same mark
        foreach ($node->marks as $otherMark) {
            if ($mark == $otherMark) {
                return false;
            }
        }

        return true;
    }

    private function renderOpeningTag($extension, $nodeOrMark, $renderHTML = false)
    {
        /**
         * public function addAttributes()
         * {
         *     return [
         *        'color' => [
         *            'renderHTML' => function ($attributes) {
         *                return [
         *                    'style' => "color: {$attributes['color']}",
         *                ];
         *            }
         *        ],
         *    ];
         * }
         */
        $HTMLAttributes = [];

        if (method_exists($extension, 'addAttributes')) {
            foreach ($extension->addAttributes() as $attribute => $configuration) {
                // 'rendered' => false
                if (isset($configuration['rendered']) && $configuration['rendered'] === false) {
                    continue;
                }

                // 'default' => 'foobar'
                if (! isset($nodeOrMark->attrs->{$attribute}) && isset($configuration['default'])) {
                    if (! isset($nodeOrMark->attrs)) {
                        $nodeOrMark->attrs = new stdClass;
                    }

                    $nodeOrMark->attrs->{$attribute} = $configuration['default'];
                }

                // 'renderHTML' => fn($attributes) …
                if (isset($configuration['renderHTML'])) {
                    $value = $configuration['renderHTML']($nodeOrMark->attrs ?? new stdClass);
                } else {
                    $value = [
                        $attribute => $nodeOrMark->attrs->{$attribute} ?? null,
                    ];
                }

                if ($value !== null) {
                    $HTMLAttributes = HTML::mergeAttributes($HTMLAttributes, $value);
                }
            }
        }

        // Remove empty attributes
        $HTMLAttributes = array_filter($HTMLAttributes, fn ($HTMLAttribute) => $HTMLAttribute !== null);

        if ($renderHTML === false) {
            $renderHTML = $extension->renderHTML($nodeOrMark, $HTMLAttributes);
        }

        // ["content" => …]
        if (isset($renderHTML['content'])) {
            return $renderHTML;
        }

        // null
        if (is_null($renderHTML)) {
            return '';
        }

        // ['table', ['tbody', 0]]
        // ['table', ['class' => 'foobar'], ['tbody', 0]]
        if (is_array($renderHTML)) {
            $html = [];

            foreach ($renderHTML as $index => $renderInstruction) {
                // ['div', …]
                if (is_string($renderInstruction)) {
                    if ($nextTag = $renderHTML[$index + 1] ?? null) {
                        // ['table', ['class' => 'custom-class']]
                        if (! in_array(0, $nextTag, true)) {
                            if (is_array($nextTag) && $this->isAnAttributeArray($nextTag)) {
                                $attributes = HTML::renderAttributes($nextTag);
                            } else {
                                $attributes = '';
                            }

                            // <a href="#">
                            $html[] = "<{$renderInstruction}{$attributes}>";
                        } else {
                            $html[] = "<{$renderInstruction}>";
                        }
                    } else {
                        $html[] = "<{$renderInstruction}>";
                    }

                    // ['div', 'span']
                    if (is_array($nextTag) && ! in_array(0, $nextTag, true)) {
                        if (! $this->isAnAttributeArray($nextTag)) {
                            $html[] = $this->renderOpeningTag($extension, $nodeOrMark, $nextTag);
                            $html[] = $this->renderClosingTag($nextTag);
                        }
                    }

                    // ['div', ?, 'span']
                    if ($nextTag = $renderHTML[$index + 2] ?? null) {
                        if (! in_array(0, $nextTag, true)) {
                            if (! $this->isAnAttributeArray($nextTag)) {
                                $html[] = $this->renderOpeningTag($extension, $nodeOrMark, $nextTag);
                                $html[] = $this->renderClosingTag($nextTag);
                            }
                        }
                    }

                    continue;
                }
                // ['tbody', 0]
                // TODO: Make in_array recursive
                elseif (is_array($renderInstruction) && in_array(0, $renderInstruction, true)) {
                    $html[] = $this->renderOpeningTag($extension, $nodeOrMark, $renderInstruction);
                }
                // ['class' => 'foobar']
                elseif (is_array($renderInstruction)) {
                    continue;
                }
            }

            return join($html);
        }

        throw new \Exception('[renderOpeningTag] Failed to use renderHTML: ' . json_encode($renderHTML));
    }

    private function isAnAttributeArray($items)
    {
        if (! is_array($items)) {
            return false;
        }

        $keys = array_keys($items);

        return $keys !== array_keys($keys);
    }

    private function isSelfClosing($tag)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $element = $dom->createElement($tag, 'test');
        $dom->appendChild($element);
        $rendered = $dom->saveHTML();

        return substr_count($rendered, $tag) === 1;
    }

    private function renderClosingTag($renderHTML)
    {
        // null
        if (is_null($renderHTML)) {
            return '';
        }

        // ["content" => …]
        if (isset($renderHTML['content'])) {
            return;
        }

        // ['table', ['tbody']]
        if (is_array($renderHTML)) {
            $html = [];

            foreach (array_reverse($renderHTML) as $index => $renderInstruction) {
                // // ['div', …]
                // if (is_string($renderInstruction)) {
                //     $html[] = "</{$renderInstruction}>";

                //     $nextTag = $renderHTML[$index + 1] ?? null;

                //     // ['div', 'span']
                //     if (is_array($nextTag) && !in_array(0, $nextTag, true)) {
                //         if (!$this->isAnAttributeArray($nextTag)) {
                //             $html[] = $this->renderClosingTag($nextTag);
                //         }
                //     }

                //     // ['div', ?, 'span']
                //     if ($nextTag = $renderHTML[$index + 2] ?? null) {
                //         if (!in_array(0, $nextTag, true)) {
                //             if (!$this->isAnAttributeArray($nextTag)) {
                //                 $html[] = $this->renderClosingTag($nextTag);
                //             }
                //         }
                //     }

                //     continue;
                // }
                // // ['tbody', 0]
                // // TODO: Make in_array recursive
                // elseif (is_array($renderInstruction) && in_array(0, $renderInstruction, true)) {
                //     $html[] = $this->renderClosingTag($renderInstruction);
                // }
                // // ['class' => 'foobar']
                // elseif (is_array($renderInstruction)) {
                //     continue;
                // }
                // 'div'
                if (is_string($renderInstruction)) {
                    if ($this->isSelfClosing($renderInstruction)) {
                        return null;
                    }

                    $html[] = "</{$renderInstruction}>";
                }
                // ['div', 0]
                elseif (is_array($renderInstruction) && in_array(0, $renderInstruction)) {
                    $html[] = $this->renderClosingTag($renderInstruction);
                }
                // // ['div', ['span']]
                // elseif (is_array($renderInstruction) && count($renderInstruction) &&!$this->isAnAttributeArray($renderInstruction)) {
                //     $html[] = $this->renderClosingTag($renderInstruction);
                // }
            }

            return join($html);
        }

        throw new \Exception('[renderClosingTag] Failed to use renderHTML: ' . json_encode($renderHTML));
    }

    public function render(array $value)
    {
        $html = [];

        // transform document to object
        $this->document = json_decode(json_encode($value));

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $index => $node) {
            $previousNode = $content[$index - 1] ?? null;
            $nextNode = $content[$index + 1] ?? null;

            $html[] = $this->renderNode($node, $previousNode, $nextNode);
        }

        return join($html);
    }
}
