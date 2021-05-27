<?php

namespace Tiptap\HTMLOutput\Contracts;

class Node
{
    protected $name;

    public function renderHTML($node)
    {
        return null;
    }

    public function text($node)
    {
        return null;
    }
}
