<?php

namespace Tiptap\HTMLOutput\Contracts;

class Mark
{
    protected $mark;
    protected $name;

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

    public function renderHTML()
    {
        return null;
    }

    public function text()
    {
        return $this->mark->text;
    }
}
