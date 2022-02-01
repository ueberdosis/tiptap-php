<?php declare(strict_types=1);

namespace Tiptap\Core;

abstract class Mark
{
    public static string $name;
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

    abstract public function renderHTML($mark, array $HTMLAttributes = []): array;
    abstract public function parseHTML(): array;
}
