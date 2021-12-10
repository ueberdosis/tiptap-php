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

    private function renderNode($node, $previousNode = null, $nextNode = null): string
    {
        $html = [];

        if (isset($node->marks)) {
            foreach ($node->marks as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = $class;

                    if (!$this->isMarkOrNode($mark, $renderClass)) {
                        continue;
                    }

                    if (!$this->markShouldOpen($mark, $previousNode)) {
                        continue;
                    }

                    $html[] = $this->renderOpeningTag($renderClass::renderHTML($mark));
                }
            }
        }

        foreach ($this->nodes as $extension) {
            if (!$this->isMarkOrNode($node, $extension)) {
                continue;
            }

            $html[] = $this->renderOpeningTag($extension::renderHTML($node));
            break;
        }

        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $previousNestedNode = $node->content[$index - 1] ?? null;
                $nextNestedNode = $node->content[$index + 1] ?? null;

                $html[] = $this->renderNode($nestedNode, $previousNestedNode, $nextNestedNode);
                $previousNode = $nestedNode;
            }
        } elseif (isset($node->text)) {
            $html[] = htmlspecialchars($node->text, ENT_QUOTES, 'UTF-8');
        }

        foreach ($this->nodes as $extension) {
            if (!$this->isMarkOrNode($node, $extension)) {
                continue;
            }

            $html[] = $this->renderClosingTag($extension::renderHTML($node));
        }

        if (isset($node->marks)) {
            foreach (array_reverse($node->marks) as $mark) {
                foreach ($this->marks as $extension) {
                    if (!$this->isMarkOrNode($mark, $extension)) {
                        continue;
                    }

                    if (!$this->markShouldClose($mark, $nextNode)) {
                        continue;
                    }

                    $html[] = $this->renderClosingTag($extension::renderHTML($mark));
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
        if (!$node) {
            return true;
        }

        if (!property_exists($node, 'marks')) {
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
        // 'strong'
        if (is_string($renderHTML)) {
            return "<{$renderHTML}>";
        }

        // ['tag' => 'a', 'attrs' => ['href' => '#']]
        if (isset($renderHTML['tag'])) {
            $attributes = [];

            foreach ($renderHTML['attrs'] ?? [] as $name => $value) {
                $attributes[] = " {$name}=\"{$value}\"";
            }

            $attributes = join($attributes);

            // <a href="#">
            return "<{$renderHTML['tag']}{$attributes}>";
        }

        // ['table', 'tbody']
        if (is_array($renderHTML)) {
            $html = [];

            foreach ($renderHTML as $tag) {
                $html[] = "<{$tag}>";
            }

            return join($html);
        }

        // TODO:
        // [['tag' => 'table', 'attrs' => ['width' => '100%']], ['tag' => 'tbody']]
        // if (…) {
        //     …
        // }

        throw new \Exception('[renderOpeningTag] Failed to use renderHTML: ' . json_encode($renderHTML));
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
        // 'strong'
        if (is_string($renderHTML)) {
            // self-closing tag
            if ($this->isSelfClosing($renderHTML)) {
                return null;
            }

            return "</{$renderHTML}>";
        }

        // ['tag' => 'a', 'attrs' => ['href' => '#']]
        if (isset($renderHTML['tag'])) {
            if ($this->isSelfClosing($renderHTML['tag'])) {
                return null;
            }

            return "</{$renderHTML['tag']}>";
        }

        // ['table', 'tbody']
        if (is_array($renderHTML)) {
            $html = [];

            foreach (array_reverse($renderHTML) as $tag) {
                if ($this->isSelfClosing($tag)) {
                    return null;
                }
                $html[] = "</{$tag}>";
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
}
