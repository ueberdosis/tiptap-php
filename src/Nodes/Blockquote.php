<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Blockquote extends Node
{
    public static $name = 'blockquote';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'blockquote',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        return ['blockquote', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
