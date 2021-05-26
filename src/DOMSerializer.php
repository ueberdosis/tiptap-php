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

    private function renderNode($node, $prevNode = null, $nextNode = null): ?DOMSerializerPointer
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
                        $pointer = $this->renderHTML($renderClass);

                        if ($this->markShouldOpen($mark, $prevNode)) {
                            if ($element) {
                                // echo "append {$pointer->element->tagName} to {$element->element->tagName}.\n";
                                $element = new DOMSerializerPointer(
                                    $element->content,
                                    $element->content->appendChild($pointer->element)
                                );
                            } else {
                                $element = $pointer;
                            }
                        }
                    }
                }
            }
        }

        // Loop through all nodes
        foreach ($this->nodes as $class) {
            $renderClass = new $class($node);

            if ($renderClass->matching()) {
                $pointer = $this->renderHTML($renderClass);

                // var_dump("{$pointer->element->tagName}, {$pointer->content->tagName}");

                // if ($pointer->content->tagName === 'tbody') {
                //     var_dump($element);
                //     die();
                // }s

                if ($element) {
                    // echo "append {$pointer->element->tagName} to {$element->element->tagName}.\n";
                    $element->content->appendChild($pointer->element);
                } else {
                    // echo "set element to {$pointer->element->tagName}.\n";
                    // if ($pointer->element->tagName === 'table') {
                    //     echo "ERROR: should set element to {$pointer->content->tagName}\n.";
                    // }

                    $element = $pointer;
                }

                break;
            }
        }

        // Render the content
        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $prevNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                $pointer = $this->renderNode($nestedNode, $prevNestedNode, $nextNestedNode);

                if ($pointer->element) {
                    if ($element) {
                        // $tagName = $pointer->element->tagName ?? 'unknown';
                        // echo "this: append {$tagName} to {$element->element->tagName}.\n";
                        $element->content->appendChild($pointer->element);
                    } else {
                        $element = $pointer;
                    }
                }

                $prevNode = $nestedNode;
            }

            return $element;
        }

        // if ($text = $renderClass->text()) {
        //     $text = $this->dom->createTextNode($text);
        //     // echo "append text to {$child->tagName}.\n";
        //     // TODO: $child!? Should be $element->content
        //     $child->appendChild($text);
        // }

        if (isset($node->text)) {
            // echo "add text\n";
            $text = $this->dom->createTextNode($node->text);

            if (!$element) {
                return new DOMSerializerPointer($text);
            }

            // if ($child) {
            //     // echo "append text to {$child->tagName}.\n";
            //     // TODO: $child!? Should be $element->content
            //     $child->appendChild($text);
            // }

            // echo "append text to {$element->content->tagName}.\n";
            $element->content->appendChild($text);

            return $element;
        }

        return $element;
    }

    private function renderHTML($renderClass): DOMSerializerPointer
    {
        $renderHTML = $renderClass->tag();

        // 'strong'
        if (is_string($renderHTML)) {
            return new DOMSerializerPointer($this->dom->createElement(
                $renderHTML
            ));
        }

        // ['tag' => 'a', 'attrs' => ['href' => '#']]
        if (isset($renderHTML['tag'])) {
            $element = new DOMSerializerPointer($this->dom->createElement(
                $renderHTML['tag']
            ));

            foreach ($renderHTML['attrs'] ?? [] as $name => $value) {
                $attribute = $this->dom->createAttribute($name);
                $attribute->value = $value;
                // echo "append `${name}` attribute to {$element->element->tagName}.\n";
                $element->content->appendChild($attribute);
            }

            return $element;
        }

        // ['table', 'tbody']
        if (is_array($renderHTML)) {
            $element = $this->dom->createElement(array_shift($renderHTML));
            $lastElement = $element;

            foreach ($renderHTML as $tag) {
                $temporaryElement = $this->dom->createElement($tag);
                // echo "append {$temporaryElement->tagName} to {$lastElement->tagName}.\n";
                $lastElement = $lastElement->appendChild($temporaryElement);
            }

            return new DOMSerializerPointer($element, $lastElement);
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

            $pointer = $this->renderNode($node, $prevNode, $nextNode);

            if ($pointer && $pointer->element) {
                $this->dom->appendChild($pointer->element);
            }
        }

        return trim(
            $this->dom->saveHTML()
        );
    }
}
