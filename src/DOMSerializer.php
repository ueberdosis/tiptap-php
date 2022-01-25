<?php

namespace Tiptap;

use DOMDocument;

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

                    $html[] = $this->renderOpeningTag($renderClass->renderHTML($mark));
                }
            }
        }

        foreach ($this->schema->nodes as $extension) {
            if (! $this->isMarkOrNode($node, $extension)) {
                continue;
            }

            $html[] = $this->renderOpeningTag($extension->renderHTML($node));

            break;
        }

        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $previousNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                $html[] = $this->renderNode($nestedNode, $previousNestedNode, $nextNestedNode);
            }
        } elseif (isset($node->text)) {
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

    private function renderOpeningTag($renderHTML)
    {
        // null
        if (is_null($renderHTML)) {
            return '';
        }

        // 'strong'
        if (is_string($renderHTML)) {
            return "<{$renderHTML}>";
        }

        // ['table', ['tbody', 0]]
        // ['table', ['class' => 'foobar'], ['tbody', 0]]
        if (is_array($renderHTML)) {
            $html = [];

            foreach ($renderHTML as $index => $tag) {
                // 'table'
                if (is_string($tag)) {
                    // next item: ['class' => 'foobar']
                    if ($nextTag = $renderHTML[$index + 1] ?? null) {
                        if (is_array($nextTag) && ! in_array(0, $nextTag)) {
                            $attributes = $this->renderHTMLFromAttributes($nextTag);

                            // <a href="#">
                            $html[] = "<{$tag}{$attributes}>";

                            continue;
                        }
                    }

                    $html[] = "<{$tag}>";
                }
                // ['tbody', 0]
                // TODO: Make recursive
                elseif (is_array($tag) && in_array(0, $tag)) {
                    $html[] = $this->renderOpeningTag($tag);
                }
                // ['class' => 'foobar']
                elseif (is_array($tag)) {
                    continue;
                }
            }

            return join($html);
        }

        throw new \Exception('[renderOpeningTag] Failed to use renderHTML: ' . json_encode($renderHTML));
    }

    private function renderHTMLFromAttributes($attrs)
    {
        $attributes = [];

        foreach ($attrs ?? [] as $name => $value) {
            $attributes[] = " {$name}=\"{$value}\"";
        }

        return join($attributes);
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

        // 'strong'
        if (is_string($renderHTML)) {
            // self-closing tag
            if ($this->isSelfClosing($renderHTML)) {
                return null;
            }

            return "</{$renderHTML}>";
        }

        // ['table', ['tbody']]
        if (is_array($renderHTML)) {
            $html = [];

            foreach (array_reverse($renderHTML) as $tag) {
                // 'table
                if (is_string($tag)) {
                    if ($this->isSelfClosing($tag)) {
                        return null;
                    }
                    $html[] = "</{$tag}>";
                }
                // ['tbody', 0]
                elseif (is_array($tag) && in_array(0, $tag)) {
                    $html[] = $this->renderClosingTag($tag);
                }
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
