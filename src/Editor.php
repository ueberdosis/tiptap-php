<?php

namespace Tiptap;

use Exception;

class Editor
{
    protected $document;

    public $schema;

    public $configuration = [
        'extensions' => [
            Nodes\Blockquote::class,
            Nodes\BulletList::class,
            Nodes\CodeBlock::class,
            Nodes\HardBreak::class,
            Nodes\Heading::class,
            Nodes\HorizontalRule::class,
            Nodes\Image::class,
            Nodes\ListItem::class,
            Nodes\Mention::class,
            Nodes\OrderedList::class,
            Nodes\Paragraph::class,
            Nodes\Table::class,
            Nodes\TableCell::class,
            Nodes\TableHeader::class,
            Nodes\TableRow::class,
            Nodes\Text::class,
            Marks\Bold::class,
            Marks\Code::class,
            Marks\Highlight::class,
            Marks\Italic::class,
            Marks\Link::class,
            Marks\Strike::class,
            Marks\Subscript::class,
            Marks\Superscript::class,
            Marks\Underline::class,
        ],
    ];

    public function __construct(array $configuration = [])
    {
        $this->configuration = array_merge_recursive($this->configuration, $configuration);
        $this->schema = Schema::from($this->configuration['extensions']);
    }

    public function setContent($value)
    {
        if ($this->getContentType($value) === 'HTML') {
            $this->document = (new DOMParser($this->schema))->render($value);
        } elseif ($this->getContentType($value) === 'Array') {
            $this->document = json_decode(json_encode($value), true);
        } elseif ($this->getContentType($value) === 'JSON') {
            $this->document = json_decode($value, true);
        }

        $this->document = $this->schema::apply($this->document);

        return $this;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getJSON()
    {
        return json_encode($this->document);
    }

    public function getHTML()
    {
        return (new DOMSerializer($this->schema))->render($this->document);
    }

    public function sanitize($value)
    {
        if ($this->getContentType($value) === 'HTML') {
            return $this->setContent($value)->getHTML();
        } elseif ($this->getContentType($value) === 'Array') {
            return $this->setContent($value)->getDocument();
        } elseif ($this->getContentType($value) === 'JSON') {
            return $this->setContent($value)->getJSON();
        }
    }

    public function getContentType($value)
    {
        if (is_string($value)) {
            try {
                /**
                 * @psalm-suppress UnusedFunctionCall
                 */
                json_decode($value, true, 512, JSON_THROW_ON_ERROR);

                return 'JSON';
            } catch (Exception $exception) {
                return 'HTML';
            }
        }

        if (is_array($value)) {
            return 'Array';
        }

        throw new Exception('Unknown format passed to setContent().');
    }
}
