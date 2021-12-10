<?php

namespace Tiptap;

use Exception;

class Utils
{
    public static function parseInlineStyles($DOMNode)
    {
        $results = [];

        if (!method_exists($DOMNode, 'getAttribute')) {
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

    public static function hasInlineStyle($DOMNode, $value)
    {
        $styles = self::parseInlineStyles($DOMNode);

        if (is_string($value)) {
            return in_array($value, array_keys($styles));
        }

        if (is_array($value)) {
            return array_diff($value, $styles) == [];
        }

        throw new Exception('Can’t compare inline styles to ' . json_encode($value));
    }

    public static function getInlineStyle($DOMNode, $attribute)
    {
        return self::parseInlineStyles($DOMNode)[$attribute] ?? null;
    }
}
