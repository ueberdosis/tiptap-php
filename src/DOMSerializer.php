<?php

namespace Tiptap;

use DOMDocument;

class DOMSerializer
{
    protected $dom;

    protected $document;

    protected $nodes = [
        HTMLOutput\Nodes\Blockquote::class,
        HTMLOutput\Nodes\BulletList::class,
        HTMLOutput\Nodes\CodeBlock::class,
        HTMLOutput\Nodes\HardBreak::class,
        HTMLOutput\Nodes\Heading::class,
        HTMLOutput\Nodes\HorizontalRule::class,
        HTMLOutput\Nodes\Image::class,
        HTMLOutput\Nodes\ListItem::class,
        HTMLOutput\Nodes\OrderedList::class,
        HTMLOutput\Nodes\Paragraph::class,
        HTMLOutput\Nodes\Table::class,
        HTMLOutput\Nodes\TableCell::class,
        HTMLOutput\Nodes\TableHeader::class,
        HTMLOutput\Nodes\TableRow::class,
    ];

    protected $marks = [
        HTMLOutput\Marks\Bold::class,
        HTMLOutput\Marks\Code::class,
        HTMLOutput\Marks\Italic::class,
        HTMLOutput\Marks\Link::class,
        HTMLOutput\Marks\Subscript::class,
        HTMLOutput\Marks\Underline::class,
        HTMLOutput\Marks\Strike::class,
        HTMLOutput\Marks\Superscript::class,
    ];

    public function __construct()
    {
        $this->dom = new DOMDocument('1.0', 'utf-8');
    }

    public function document($value)
    {
        if (is_string($value)) {
            $value = json_decode($value);
        } elseif (is_array($value)) {
            $value = json_decode(json_encode($value));
        }

        $this->document = $value;

        return $this;
    }

    private function renderNode($node, $prevNode = null, $nextNode = null)
    {
        $element = null;
        $child = null;

        if (isset($node->marks)) {
            foreach ($node->marks as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = new $class($mark);

                    if ($renderClass->matching() && $this->markShouldOpen($mark, $prevNode)) {
                        $child = $this->renderHTML($renderClass);

                        $element ? $element->appendChild($child) : $element = $child;
                    }
                }
            }
        }

        foreach ($this->nodes as $class) {
            $renderClass = new $class($node);

            if ($renderClass->matching()) {
                $child = $this->renderHTML($renderClass);

                $element ? $element->appendChild($child) : $element = $child;

                break;
            }
        }

        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $prevNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                if ($child = $this->renderNode($nestedNode, $prevNestedNode, $nextNestedNode)) {
                    $element ? $element->appendChild($child) : $element = $child;
                }

                $prevNode = $nestedNode;
            }
        } elseif (isset($node->text)) {
            // TODO: Check escaping
            // $html[] = htmlspecialchars($node->text, ENT_QUOTES, 'UTF-8');
            $text = $this->dom->createTextNode($node->text);

            if ($child) {
                $child->appendChild($text);
            } elseif ($element) {
                $element->appendChild($text);
            } else {
                $element = $text;
            }
        }
        // TODO: Shouldn’t that come before the other if?
        elseif ($text = $renderClass->text()) {
            $text = $this->dom->createTextNode($text);
            $child->appendChild($text);
        }

        return $element;
    }

    private function renderHTML($renderClass)
    {
        $renderHTML = $renderClass->tag();

        if (is_string($renderHTML)) {
            $child = $this->dom->createElement(
                $renderHTML
            );
        } elseif (isset($renderHTML['tag'])) {
            $child = $this->dom->createElement(
                $renderHTML['tag']
            );

            foreach ($renderHTML['attrs'] ?? [] as $name => $value) {
                $attribute = $this->dom->createAttribute($name);
                $attribute->value = $value;
                $child->appendChild($attribute);
            }
        } elseif (is_array($renderHTML)) {
            $tree = null;
            foreach ($renderHTML as $tag) {
                $newElement = $this->dom->createElement(
                    $tag
                );

                // TODO: WHAT NOW?
                // phpunit --filter table_node_gets_rendered_correctly
            }
        } else {
            // TODO: Improve error output
            var_dump($renderHTML);

            throw new \Exception("Failed to use renderHTML output.");
        }

        return $child;
    }

    private function markShouldOpen($mark, $prevNode)
    {
        return $this->nodeHasMark($prevNode, $mark);
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

        // Other node has same mark
        foreach ($node->marks as $otherMark) {
            if ($mark == $otherMark) {
                return false;
            }
        }

        return true;
    }

    private function renderOpeningTag($tags)
    {
        $tags = (array) $tags;

        if (! $tags || ! count($tags)) {
            return null;
        }

        return join('', array_map(function ($item) {
            if (is_string($item)) {
                return "<{$item}>";
            }

            $attrs = '';
            if (isset($item['attrs'])) {
                foreach ($item['attrs'] as $attribute => $value) {
                    $attrs .= " {$attribute}=\"{$value}\"";
                }
            }

            return "<{$item['tag']}{$attrs}>";
        }, $tags));
    }

    private function renderClosingTag($tags)
    {
        $tags = (array) $tags;
        $tags = array_reverse($tags);

        if (! $tags || ! count($tags)) {
            return null;
        }

        return join('', array_map(function ($item) {
            if (is_string($item)) {
                return "</{$item}>";
            }

            return "</{$item['tag']}>";
        }, $tags));
    }

    public function render($value)
    {
        $this->document($value);

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $index => $node) {
            $prevNode = $content[$index - 1] ?? null;
            $nextNode = $content[$index + 1] ?? null;

            if ($child = $this->renderNode($node, $prevNode, $nextNode)) {
                $this->dom->appendChild($child);
            }
        }

        return trim(
            $this->dom->saveHTML()
        );
    }
}
