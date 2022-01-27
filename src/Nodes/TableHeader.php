<?php declare(strict_types=1);

namespace Tiptap\Nodes;

class TableHeader extends TableCell
{
    public static $name = 'tableHeader';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'th',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        // TODO: Add HTMLAttributes
        return ['th', self::getAttrs($node), 0];
    }
}
