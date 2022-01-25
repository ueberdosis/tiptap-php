<?php

namespace Tiptap\Contracts;

class Mark
{
    public static $name;

    public function renderHTML($mark)
    {
        return null;
    }

    public function parseHTML()
    {
        return [];
    }
}
