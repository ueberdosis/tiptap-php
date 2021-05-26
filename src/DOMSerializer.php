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

    private function renderNode($node, $prevNode = null, $nextNode = null)
    {
        // The element that’s returned
        $element = null;

        // A temporary child element
        $child = null;

        // Loop through all marks
        if (isset($node->marks)) {
            foreach ($node->marks as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = new $class($mark);

                    if ($renderClass->matching()) {
                        $child = $this->renderHTML($renderClass);

                        if ($this->markShouldOpen($mark, $prevNode)) {
                            $element ? $element->appendChild($child) : $element = $child;
                        }
                    }
                }
            }
        }

        // Loop through all nodes
        foreach ($this->nodes as $class) {
            $renderClass = new $class($node);

            if ($renderClass->matching()) {
                $child = $this->renderHTML($renderClass);

                var_dump($child->tagName);

                $element ? $element->appendChild($child) : $element = $child;

                break;
            }
        }

        // Render the content
        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $prevNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                if ($child = $this->renderNode($nestedNode, $prevNestedNode, $nextNestedNode)) {
                    $element ? $element->appendChild($child) : $element = $child;
                }

                $prevNode = $nestedNode;
            }
        } elseif ($text = $renderClass->text()) {
            $text = $this->dom->createTextNode($text);
            $child->appendChild($text);
        } elseif (isset($node->text)) {
            $text = $this->dom->createTextNode($node->text);

            if ($child) {
                $child->appendChild($text);
            } elseif ($element) {
                $element->appendChild($text);
            } else {
                $element = $text;
            }
        }

        return $element;
    }

    private function renderHTML($renderClass)
    {
        $renderHTML = $renderClass->tag();

        // 'strong'
        if (is_string($renderHTML)) {
            return $this->dom->createElement(
                $renderHTML
            );
        }

        // ['tag' => 'a', 'attrs' => ['href' => '#']]
        if (isset($renderHTML['tag'])) {
            $element = $this->dom->createElement(
                $renderHTML['tag']
            );

            foreach ($renderHTML['attrs'] ?? [] as $name => $value) {
                $attribute = $this->dom->createAttribute($name);
                $attribute->value = $value;
                $element->appendChild($attribute);
            }

            return $element;
        }

        // ['table', 'tbody']
        if (is_array($renderHTML)) {
            $element = $this->dom->createElement(array_shift($renderHTML));
            $lastElement = $element;

            foreach ($renderHTML as $tag) {
                $lastElement = $lastElement->appendChild($this->dom->createElement($tag));
            }

            return $element;
        }

        // TODO:
        // [['tag' => 'table', 'attrs' => ['width' => '100%']], ['tag' => 'tbody']]

        // TODO: Improve error output
        var_dump($renderHTML);
        throw new \Exception("Failed to use renderHTML output.");
    }

    private function markShouldOpen($mark, $prevNode)
    {
        return $this->nodeHasMark($prevNode, $mark);
    }

    // private function markShouldClose($mark, $nextNode)
    // {
    //     return $this->nodeHasMark($nextNode, $mark);
    // }

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

    public function render($value)
    {
        $this->document = $value;

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
