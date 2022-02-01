<?php declare(strict_types=1);

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Marks\Bold;
use Tiptap\Marks\Code;
use Tiptap\Marks\Italic;
use Tiptap\Marks\Strike;
use Tiptap\Nodes\Blockquote;
use Tiptap\Nodes\BulletList;
use Tiptap\Nodes\CodeBlock;
use Tiptap\Nodes\HardBreak;
use Tiptap\Nodes\Heading;
use Tiptap\Nodes\HorizontalRule;
use Tiptap\Nodes\ListItem;
use Tiptap\Nodes\OrderedList;
use Tiptap\Nodes\Paragraph;
use Tiptap\Nodes\Text;

class StarterKit extends Extension
{
    public static string $name = 'starterKit';

    public function addOptions(): array
    {
        return [
            'blockquote' => [],
            'bulletList' => [],
            'codeBlock' => [],
            'hardBreak' => [],
            'heading' => [],
            'horizontalRule' => [],
            'listItem' => [],
            'orderedList' => [],
            'paragraph' => [],
            'text' => [],
            'bold' => [],
            'code' => [],
            'italic' => [],
            'strike' => [],
        ];
    }

    public function addExtensions(): array
    {
        return array_filter([
            $this->options['blockquote'] !== false
                ? new Blockquote($this->options['blockquote'])
                : null,
            $this->options['bulletList'] !== false
                ? new BulletList($this->options['bulletList'])
                : null,
            $this->options['codeBlock'] !== false
                ? new CodeBlock($this->options['codeBlock'])
                : null,
            $this->options['hardBreak'] !== false
                ? new HardBreak($this->options['hardBreak'])
                : null,
            $this->options['heading'] !== false
                ? new Heading($this->options['heading'])
                : null,
            $this->options['horizontalRule'] !== false
                ? new HorizontalRule($this->options['horizontalRule'])
                : null,
            $this->options['listItem'] !== false
                ? new ListItem($this->options['listItem'])
                : null,
            $this->options['orderedList'] !== false
                ? new OrderedList($this->options['orderedList'])
                : null,
            $this->options['paragraph'] !== false
                ? new Paragraph($this->options['paragraph'])
                : null,
            $this->options['text'] !== false
                ? new Text($this->options['text'])
                : null,
            $this->options['bold'] !== false
                ? new Bold($this->options['bold'])
                : null,
            $this->options['code'] !== false
                ? new Code($this->options['code'])
                : null,
            $this->options['italic'] !== false
                ? new Italic($this->options['italic'])
                : null,
            $this->options['strike'] !== false ? new Strike($this->options['strike']) : null,
        ]);
    }
}
