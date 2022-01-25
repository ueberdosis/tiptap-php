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
            new \Tiptap\Nodes\Image(),
            new \Tiptap\Nodes\ListItem(),
            new \Tiptap\Nodes\Mention(),
            new \Tiptap\Nodes\OrderedList(),
            new \Tiptap\Nodes\Paragraph(),
            new \Tiptap\Nodes\Table(),
            new \Tiptap\Nodes\TableCell(),
            new \Tiptap\Nodes\TableHeader(),
            new \Tiptap\Nodes\TableRow(),
            new \Tiptap\Nodes\Text(),
            new \Tiptap\Marks\Bold(),
            new \Tiptap\Marks\Code(),
            new \Tiptap\Marks\Highlight(),
            new \Tiptap\Marks\Italic(),
            new \Tiptap\Marks\Link(),
            new \Tiptap\Marks\Strike(),
            new \Tiptap\Marks\Subscript(),
            new \Tiptap\Marks\Superscript(),
            new \Tiptap\Marks\TextStyle(),
            new \Tiptap\Marks\Underline(),
        ];
    }
}
