<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;

class StarterKit extends Extension
{
    public static $name = 'starterKit';

    public function addExtensions()
    {
        return [
            new \Tiptap\Nodes\Blockquote(),
            new \Tiptap\Nodes\BulletList(),
            new \Tiptap\Nodes\CodeBlock(),
            new \Tiptap\Nodes\HardBreak(),
            new \Tiptap\Nodes\Heading(),
            new \Tiptap\Nodes\HorizontalRule(),
            new \Tiptap\Nodes\ListItem(),
            new \Tiptap\Nodes\OrderedList(),
            new \Tiptap\Nodes\Paragraph(),
            new \Tiptap\Nodes\Text(),
            new \Tiptap\Marks\Bold(),
            new \Tiptap\Marks\Code(),
            new \Tiptap\Marks\Italic(),
            new \Tiptap\Marks\Strike(),
        ];
    }
}
