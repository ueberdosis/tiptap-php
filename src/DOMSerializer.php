<?php

namespace Tiptap;

use DOMDocument;

class DOMSerializer
{
    protected $dom;

    protected $document;

    protected $nodes = [
        Nodes\Blockquote::class,
        Nodes\BulletList::class,
        Nodes\CodeBlock::class,
        Nodes\HardBreak::class,
        Nodes\Heading::class,
        Nodes\HorizontalRule::class,
        Nodes\Image::class,
        Nodes\ListItem::class,
        Nodes\OrderedList::class,
        Nodes\Paragraph::class,
        Nodes\Table::class,
        Nodes\TableCell::class,
        Nodes\TableHeader::class,
        Nodes\TableRow::class,
    ];

    protected $marks = [
        Marks\Bold::class,
        Marks\Code::class,
        Marks\Italic::class,
        Marks\Link::class,
        Marks\Subscript::class,
        Marks\Underline::class,
        Marks\Strike::class,
        Marks\Superscript::class,
    ];

    public function __construct()
    {
        $this->dom = new DOMDocument('1.0', 'utf-8');
    }

    private function renderNode($node, $prevNode = null, $nextNode = null): ?DOMSerializerPointer
    {
        // The pointer that’s returned
        $pointer = null;

        // Loop through all marks
        if (isset($node->marks)) {
            foreach ($node->marks as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = $class;

                    if ($this->isType($mark, $renderClass)) {
                        $current = $this->renderHTML(
                            $renderClass::renderHTML($mark)
                        );

                        if ($this->markShouldOpen($mark, $prevNode)) {
                            $pointer = $pointer ? new DOMSerializerPointer(
                                $pointer->content,
                                $pointer->content->appendChild($current->element)
                            ) : $current;
                        }
                    }
                }
            }
        }

        // Loop through all nodes
        foreach ($this->nodes as $class) {
            $renderClass = $class;

            if ($this->isType($node, $renderClass)) {
                $current = $this->renderHTML(
                    $renderClass::renderHTML($node)
                );

                if ($pointer) {
                    $pointer->content->appendChild($current->element);
                } else {
                    $pointer = $current;
                }

                break;
            }
        }

        // Render the content
        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $prevNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                $current = $this->renderNode($nestedNode, $prevNestedNode, $nextNestedNode);

                if ($current->element) {
                    if ($pointer) {
                        $pointer->content->appendChild($current->element);
                    } else {
                        $pointer = $current;
                    }
                }

                $prevNode = $nestedNode;
            }

            return $pointer;
        }

        if ($text = $renderClass::text($node)) {
            $text = $this->dom->createTextNode($text);

            if (! $pointer) {
                return new DOMSerializerPointer($text);
            }

            return new DOMSerializerPointer(
                $pointer->element,
                $pointer->content->appendChild($text)
            );
        }

        if (isset($node->text)) {
            $text = $node->text;
            $text = $this->dom->createTextNode($text);

            if (! $pointer) {
                return new DOMSerializerPointer($text);
            }

            return new DOMSerializerPointer($pointer->element, $pointer->content->appendChild($text));
        }

        return $pointer;
    }

    private function isType($markOrNode, $renderClass): bool
    {
        return isset($markOrNode->type) && $markOrNode->type === $renderClass::$name;
    }

    private function renderHTML($DOMOutputSpec): DOMSerializerPointer
    {
        // 'strong'
        if (is_string($DOMOutputSpec)) {
            return new DOMSerializerPointer($this->dom->createElement(
                $DOMOutputSpec
            ));
        }

        // ['tag' => 'a', 'attrs' => ['href' => '#']]
        if (isset($DOMOutputSpec['tag'])) {
            $pointer = new DOMSerializerPointer($this->dom->createElement(
                $DOMOutputSpec['tag']
            ));

            foreach ($DOMOutputSpec['attrs'] ?? [] as $name => $value) {
                $attribute = $this->dom->createAttribute($name);
                $attribute->value = $value;
                $pointer->content->appendChild($attribute);
            }

            return $pointer;
        }

        // ['table', 'tbody']
        if (is_array($DOMOutputSpec)) {
            $pointer = $this->dom->createElement(array_shift($DOMOutputSpec));
            $lastElement = $pointer;

            foreach ($DOMOutputSpec as $tag) {
                $temporaryElement = $this->dom->createElement($tag);
                $lastElement = $lastElement->appendChild($temporaryElement);
            }

            return new DOMSerializerPointer($pointer, $lastElement);
        }

        // TODO:
        // [['tag' => 'table', 'attrs' => ['width' => '100%']], ['tag' => 'tbody']]
        // if (…) {
        //     …
        // }

        throw new \Exception('Failed to use renderHTML output.');
    }

    private function markShouldOpen($mark, $prevNode): bool
    {
        return $this->nodeHasMark($prevNode, $mark);
    }

    // private function markShouldClose($mark, $nextNode): bool
    // {
    //     return $this->nodeHasMark($nextNode, $mark);
    // }

    private function nodeHasMark($node, $mark): bool
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

    public function render(array $value): string
    {
        // transform document to object
        $this->document = json_decode(json_encode($value));

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $index => $node) {
            $prevNode = $content[$index - 1] ?? null;
            $nextNode = $content[$index + 1] ?? null;

            $current = $this->renderNode($node, $prevNode, $nextNode);

            if ($current && $current->element) {
                $this->dom->appendChild($current->element);
            }
        }

        return trim(
            $this->dom->saveHTML()
        );
    }
}
