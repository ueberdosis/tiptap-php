<?php declare(strict_types=1);

namespace Tiptap\Core;

abstract class Extension
{
    public static string $name;
    public array $options = [];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->addOptions(), $options);
    }

    public function addOptions(): array
    {
        return [];
    }

    public function addExtensions(): array
    {
        return [];
    }
}
