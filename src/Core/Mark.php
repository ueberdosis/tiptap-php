<?php

namespace Tiptap\Core;

class Mark
{
    public static $name;

    public $options = [];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->addOptions(), $options);
    }

    public function addOptions()
    {
        return [];
    }

    public function addAttributes()
    {
        return [];
    }

    public function renderHTML($mark)
    {
        return null;
    }

    public function parseHTML()
    {
        return [];
    }
}
