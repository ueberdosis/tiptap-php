<?php

namespace Tiptap\Core;

abstract class Mark
{
    public static $name;
    public array $options = [];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->addOptions(), $options);
    }

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    abstract public function renderHTML($mark): array;
    abstract public function parseHTML(): array;
}
