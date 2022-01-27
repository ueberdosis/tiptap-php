<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class ListItem extends Node
{
    public static $name = 'listItem';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'li',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        return ['li', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }

    public static function wrapper($DOMNode): ?array
    {
        if (
            $DOMNode->childNodes->length === 1
            && $DOMNode->childNodes[0]->nodeName == "p"
        ) {
            return null;
        }

        return [
            'type' => 'paragraph',
        ];
    }
}
