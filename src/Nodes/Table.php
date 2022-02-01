<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Table extends Node
{
    public static string $name = 'table';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'table',
            ],
        ];
    }

    public function renderHTML($node, array $HTMLAttributes = []): ?array
    {
        return [
            'table',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            ['tbody', 0],
        ];
    }
}
