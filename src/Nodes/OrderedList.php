<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class OrderedList extends Node
{
    public static string $name = 'orderedList';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'ol',
            ],
        ];
    }

    public function addAttributes(): array
    {
        return [
            'order' => [
                'parseHTML' => fn ($DOMNode) => (int)$DOMNode->getAttribute('start') ?: null,
                'renderHTML' => fn ($attributes) => ($attributes->order ?? null) ? ['start' => $attributes->order] : null,
            ],
        ];
    }

    /**
     * @psalm-suppress UnusedVariable
     */
    public function renderHTML($node, array $HTMLAttributes = []): ?array
    {
        // TODO: Move to `addAttributes`
        $attrs = [];

        if (isset($node->attrs->order)) {
            $attrs['start'] = $node->attrs->order;
        }

        return ['ol', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
