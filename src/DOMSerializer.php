<?php

namespace Tiptap;

use DOMDocument;

class DOMSerializer
{
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

    // public function withMarks($marks = null)
    // {
    //     if (is_array($marks)) {
    //         $this->marks = $marks;
    //     }

    //     return $this;
    // }

    // public function withNodes($nodes = null)
    // {
    //     if (is_array($nodes)) {
    //         $this->nodes = $nodes;
    //     }

    //     return $this;
    // }

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

    private function renderNode($node, $prevNode = null, $nextNode = null): string
    {
        $html = [];

        if (isset($node->marks)) {
            foreach ($node->marks as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = $class;

                    if ($this->isType($mark, $renderClass) && $this->markShouldOpen($mark, $prevNode)) {
                        $html[] = $this->renderOpeningTag($mark, $renderClass);
                    }
                }
            }
        }

        foreach ($this->nodes as $class) {
            $renderClass = $class;

            if ($this->isType($node, $renderClass)) {
                $html[] = $this->renderOpeningTag($node, $renderClass);
                break;
            }
        }

        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $prevNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                $html[] = $this->renderNode($nestedNode, $prevNestedNode, $nextNestedNode);
                $prevNode = $nestedNode;
            }
        } elseif (isset($node->text)) {
            $html[] = htmlspecialchars($node->text, ENT_QUOTES, 'UTF-8');
        }
        //  elseif ($text = $renderClass->text()) {
        //     $html[] = $text;
        // }

        foreach ($this->nodes as $class) {
            $renderClass = $class;

            // if ($renderClass->selfClosing()) {
            //     continue;
            // }

            if ($this->isType($node, $renderClass)) {
                $html[] = $this->renderClosingTag($node, $renderClass);
            }
        }

        if (isset($node->marks)) {
            foreach (array_reverse($node->marks) as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = new $class($mark);

                    if ($this->isType($mark, $renderClass) && $this->markShouldClose($mark, $nextNode)) {
                        $html[] = $this->renderClosingTag($mark, $renderClass);
                    }
                }
            }
        }

        return join($html);
    }

    private function isType($markOrNode, $renderClass): bool
    {
        return isset($markOrNode->type) && $markOrNode->type === $renderClass::$name;
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
        if (!$node) {
            return true;
        }

        if (!property_exists($node, 'marks')) {
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

    private function renderOpeningTag($node, $renderClass)
    {
        $DOMOutputSpec = $renderClass::renderHTML($node);

        // 'strong'
        if (is_string($DOMOutputSpec)) {
            return "<{$DOMOutputSpec}>";
        }

        // ['tag' => 'a', 'attrs' => ['href' => '#']]
        if (isset($DOMOutputSpec['tag'])) {
            $attributes = [];

            foreach ($DOMOutputSpec['attrs'] ?? [] as $name => $value) {
                $attributes[] = " {$name}=\"{$value}\"";
            }

            $attributes = join($attributes);

            return "<{$DOMOutputSpec['tag']}{$attributes}>";
        }

        // ['table', 'tbody']
        if (is_array($DOMOutputSpec)) {
            $html = [];

            foreach ($DOMOutputSpec as $tag) {
                $html[] = "<{$tag}>";
            }

            return join($html);
        }

        // TODO:
        // [['tag' => 'table', 'attrs' => ['width' => '100%']], ['tag' => 'tbody']]
        // if (…) {
        //     …
        // }


        throw new \Exception('Failed to use renderHTML output.');

        // $tags = (array) $tags;

        // if (!$tags || !count($tags)) {
        //     return null;
        // }

        // return join('', array_map(function ($item) {
        //     if (is_string($item)) {
        //         return "<{$item}>";
        //     }

        //     $attrs = '';
        //     if (isset($item['attrs'])) {
        //         foreach ($item['attrs'] as $attribute => $value) {
        //             $attrs .= " {$attribute}=\"{$value}\"";
        //         }
        //     }

        //     return "<{$item['tag']}{$attrs}>";
        // }, $tags));
    }

    private function renderClosingTag($node, $renderClass)
    {
        $DOMOutputSpec = $renderClass::renderHTML($node);

        // 'strong'
        if (is_string($DOMOutputSpec)) {
            // self-closing tag
            $dom = new DOMDocument('1.0', 'utf-8');
            $element = $dom->createElement($DOMOutputSpec);
            $dom->appendChild($element);
            $rendered = $dom->saveHTML();
            if (substr_count($rendered, $DOMOutputSpec) === 1) {
                return '';
            }

            return "</{$DOMOutputSpec}>";
        }

        // ['tag' => 'a', 'attrs' => ['href' => '#']]
        if (isset($DOMOutputSpec['tag'])) {
            return "</{$DOMOutputSpec['tag']}>";
        }

        // ['table', 'tbody']
        if (is_array($DOMOutputSpec)) {
            $html = [];

            foreach (array_reverse($DOMOutputSpec) as $tag) {
                $html[] = "</{$tag}>";
            }

            return join($html);
        }

        throw new \Exception('Failed to use renderHTML output.');

        // $tags = (array) $tags;
        // $tags = array_reverse($tags);

        // if (!$tags || !count($tags)) {
        //     return null;
        // }

        // return join('', array_map(function ($item) {
        //     if (is_string($item)) {
        //         return "</{$item}>";
        //     }

        //     return "</{$item['tag']}>";
        // }, $tags));
    }

    public function render(array $value)
    {
        $html = [];

        // transform document to object
        $this->document = json_decode(json_encode($value));

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $index => $node) {
            $prevNode = $content[$index - 1] ?? null;
            $nextNode = $content[$index + 1] ?? null;

            $html[] = $this->renderNode($node, $prevNode, $nextNode);
        }

        return join($html);
    }

    // public function addNode($node)
    // {
    //     $this->nodes[] = $node;

    //     return $this;
    // }

    // public function addNodes($nodes)
    // {
    //     foreach ($nodes as $node) {
    //         $this->addNode($node);
    //     }

    //     return $this;
    // }

    // public function addMark($mark)
    // {
    //     $this->marks[] = $mark;

    //     return $this;
    // }

    // public function addMarks($marks)
    // {
    //     foreach ($marks as $mark) {
    //         $this->addMark($mark);
    //     }

    //     return $this;
    // }

    // public function replaceNode($search_node, $replace_node)
    // {
    //     foreach ($this->nodes as $key => $node_class) {
    //         if ($node_class == $search_node) {
    //             $this->nodes[$key] = $replace_node;
    //         }
    //     }

    //     return $this;
    // }

    // public function replaceMark($search_mark, $replace_mark)
    // {
    //     foreach ($this->marks as $key => $mark_class) {
    //         if ($mark_class == $search_mark) {
    //             $this->marks[$key] = $replace_mark;
    //         }
    //     }

    //     return $this;
    // }
}
