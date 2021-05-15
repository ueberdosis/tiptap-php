<?php

namespace Tiptap;

class DOMSerializer
{
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
        $html = [];

        if (isset($node->marks)) {
            foreach ($node->marks as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = new $class($mark);

                    if ($renderClass->matching() && $this->markShouldOpen($mark, $prevNode)) {
                        $html[] = $this->renderOpeningTag($renderClass->tag());
                    }
                }
            }
        }

        foreach ($this->nodes as $class) {
            $renderClass = new $class($node);

            if ($renderClass->matching()) {
                $html[] = $this->renderOpeningTag($renderClass->tag());

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
        } elseif ($text = $renderClass->text()) {
            $html[] = $text;
        }

        foreach ($this->nodes as $class) {
            $renderClass = new $class($node);

            if ($renderClass->selfClosing()) {
                continue;
            }

            if ($renderClass->matching()) {
                $html[] = $this->renderClosingTag($renderClass->tag());
            }
        }

        if (isset($node->marks)) {
            foreach (array_reverse($node->marks) as $mark) {
                foreach ($this->marks as $class) {
                    $renderClass = new $class($mark);

                    if ($renderClass->matching() && $this->markShouldClose($mark, $nextNode)) {
                        $html[] = $this->renderClosingTag($renderClass->tag());
                    }
                }
            }
        }

        return join($html);
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

        $html = [];

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $index => $node) {
            $prevNode = $content[$index - 1] ?? null;
            $nextNode = $content[$index + 1] ?? null;

            $html[] = $this->renderNode($node, $prevNode, $nextNode);
        }

        return join($html);
    }
}
