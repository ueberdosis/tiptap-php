<?php declare(strict_types=1);

namespace Tiptap\Utils;

use DOMNode;
use Exception;

class InlineStyle
{
    /**
     * @param string|array $value
     * @throws Exception
     */
    public static function hasAttribute(DOMNode $DOMNode, $value)
    {
        $styles = self::get($DOMNode);

        if (is_string($value)) {
            return in_array($value, array_keys($styles));
        }

        if (is_array($value)) {
            return array_diff($value, $styles) == [];
        }

        throw new Exception('Can’t compare inline styles to ' . json_encode($value));
    }

    public static function get(DOMNode $DOMNode): array
    {
        $results = [];

        if (! method_exists($DOMNode, 'getAttribute')) {
            return [];
        }

        $style = $DOMNode->getAttribute('style');

        preg_match_all(
            "/([\w-]+)\s*:\s*([^;]+)\s*;?/",
            $style,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            $results[$match[1]] = $match[2];
        }

        return $results;
    }

    public static function getAttribute(DOMNode $DOMNode, string $attribute): ?string
    {
        return self::get($DOMNode)[$attribute] ?? null;
    }
}
