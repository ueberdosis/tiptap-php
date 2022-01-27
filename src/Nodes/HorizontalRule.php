<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class HorizontalRule extends Node
{
    public static $name = 'horizontalRule';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'hr',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        return ['hr', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes)];
    }
}
