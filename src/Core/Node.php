<?php

namespace Tiptap\Core;

class Node extends Extension
{
    public static $priority = 100;

    public static $topNode = false;

    public static $marks = '_';

    public static $inline = false;

    /**
     * Wrap inline content in a paragraph, for nodes that only allow block content.
     */
    public static $wrapInlineContent = false;

    public function addAttributes()
    {
        return [];
    }

    public function parseHTML()
    {
        return [];
    }

    public function renderHTML($node)
    {
        return null;
    }
}
