<?php

namespace Tiptap\HTMLOutput\Marks;

class Mark
{
    protected $mark;
    protected $name;
    protected $tagName = null;

    public function __construct($mark)
    {
        $this->mark = $mark;
    }

    public function matching()
    {
        if (isset($this->mark->type)) {
            return $this->mark->type === $this->name;
        }

        return false;
    }

    public function tag()
    {
        return $this->tagName;
    }
}
