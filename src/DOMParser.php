<?php

namespace Tiptap;

use DOMElement;
use DOMDocument;

class DOMParser
{
    protected $document;

    protected $storedMarks = [];

    protected $marks = [
        HTML\Marks\Bold::class,
        HTML\Marks\Code::class,
        HTML\Marks\Italic::class,
        HTML\Marks\Link::class,
        HTML\Marks\Strike::class,
        HTML\Marks\Subscript::class,
        HTML\Marks\Superscript::class,
        HTML\Marks\Underline::class,
    ];

    protected $nodes = [
        HTML\Nodes\Blockquote::class,
        HTML\Nodes\BulletList::class,
        HTML\Nodes\CodeBlock::class,
        HTML\Nodes\CodeBlockWrapper::class,
        HTML\Nodes\HardBreak::class,
        HTML\Nodes\Heading::class,
        HTML\Nodes\HorizontalRule::class,
        HTML\Nodes\Image::class,
        HTML\Nodes\ListItem::class,
        HTML\Nodes\OrderedList::class,
        HTML\Nodes\Paragraph::class,
        HTML\Nodes\Table::class,
        HTML\Nodes\TableCell::class,
        HTML\Nodes\TableHeader::class,
        HTML\Nodes\TableRow::class,
        HTML\Nodes\TableWrapper::class,
        HTML\Nodes\Text::class,
        HTML\Nodes\User::class,
    ];

    public function render(string $value): array
    {
        $this->setDocument($value);

        $content = $this->renderChildren(
            $this->getDocumentBody()
        );

        return [
                'type'    => 'doc',
                'content' => $content,
            ];
    }

    private function setDocument(string $value): DOMParser
    {
        libxml_use_internal_errors(true);

        $this->document = new DOMDocument;
        $this->document->loadHTML(
            $this->wrapHtmlDocument(
                $this->stripWhitespace($value)
            )
        );

        return $this;
    }

    private function wrapHtmlDocument($value)
    {
        return '<?xml encoding="utf-8" ?>' . $value;
    }

    private function stripWhitespace(string $value): string
    {
        return (new Minify)->process($value);
    }

    private function getDocumentBody(): DOMElement
    {
        return $this->document->getElementsByTagName('body')->item(0);
    }

    private function renderChildren($node): array
    {
        $nodes = [];

        foreach ($node->childNodes as $child) {
            if ($class = $this->getMatchingNode($child)) {
                $item = $class->data();

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

                if ($class->wrapper) {
                    $item['content'] = [
                        array_merge($class->wrapper, [
                            'content' => @$item['content'] ?: [],
                        ]),
                    ];
                }

                array_push($nodes, $item);
            } elseif ($class = $this->getMatchingMark($child)) {
                array_push($this->storedMarks, $class->data());

                if ($child->hasChildNodes()) {
                    $nodes = array_merge($nodes, $this->renderChildren($child));
                }

                array_pop($this->storedMarks);
            } elseif ($child->hasChildNodes()) {
                $nodes = array_merge($nodes, $this->renderChildren($child));
            }
        }

        return $nodes;
    }

    private function getMatchingNode($item)
    {
        return $this->getMatchingClass($item, $this->nodes);
    }

    private function getMatchingMark($item)
    {
        return $this->getMatchingClass($item, $this->marks);
    }

    private function getMatchingClass($node, $classes)
    {
        foreach ($classes as $class) {
            $instance = new $class($node);

            if ($instance->parseHTML()) {
                return $instance;
            }
        }

        return false;
    }
}
