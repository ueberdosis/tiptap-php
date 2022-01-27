<?php declare(strict_types=1);

namespace Tiptap\Core;

abstract class Node
{
    public static $name;
    public static $marks = '_';
    public array $options = [];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->addOptions(), $options);
    }

     public function addOptions(): array
     {
         return [
             'HTMLAttributes' => [],
         ];
     }

    public function parseHTML(): array
    {
        return [];
    }

    public function renderHTML($node, array $HTMLAttributes = []): ?array
    {
        return null;
    }

    public static function wrapper($DOMNode): ?array
    {
        return null;
    }
}
