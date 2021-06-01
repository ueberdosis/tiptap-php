<?php

namespace Tiptap;

use DOMDocument;
use DOMElement;

class DOMParser
{
    protected $document;

    protected $storedMarks = [];

    protected $marks = [
        JSONOutput\Marks\Bold::class,
        JSONOutput\Marks\Code::class,
        JSONOutput\Marks\Italic::class,
        JSONOutput\Marks\Link::class,
        JSONOutput\Marks\Strike::class,
        JSONOutput\Marks\Subscript::class,
        JSONOutput\Marks\Superscript::class,
        JSONOutput\Marks\Underline::class,
    ];

    protected $nodes = [
        JSONOutput\Nodes\Blockquote::class,
        JSONOutput\Nodes\BulletList::class,
        JSONOutput\Nodes\CodeBlock::class,
        JSONOutput\Nodes\CodeBlockWrapper::class,
        JSONOutput\Nodes\HardBreak::class,
        JSONOutput\Nodes\Heading::class,
        JSONOutput\Nodes\HorizontalRule::class,
        JSONOutput\Nodes\Image::class,
        JSONOutput\Nodes\ListItem::class,
        JSONOutput\Nodes\OrderedList::class,
        JSONOutput\Nodes\Paragraph::class,
        JSONOutput\Nodes\Table::class,
        JSONOutput\Nodes\TableCell::class,
        JSONOutput\Nodes\TableHeader::class,
        JSONOutput\Nodes\TableRow::class,
        JSONOutput\Nodes\TableWrapper::class,
        JSONOutput\Nodes\Text::class,
        JSONOutput\Nodes\User::class,
    ];

    public function render(string $value): array
    {
        $this->setDocument($value);

        $content = $this->renderChildren(
            $this->getDocumentBody()
        );

        return [
            'type' => 'doc',
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
                $item = $class->data($child);

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
                array_push($this->storedMarks, $class->data($child));

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
            $instance = new $class;

            if ($instance->parseHTML($node)) {
                return $instance;
            }
        }

        return false;
    }
}
