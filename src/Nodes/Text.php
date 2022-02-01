<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class Text extends Node
{
    public static string $name = 'text';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => '#text',
            ],
        ];
    }
}
