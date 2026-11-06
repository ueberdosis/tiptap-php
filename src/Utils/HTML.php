<?php

namespace Tiptap\Utils;

class HTML
{
    /**
     * Merge an associative array of attributes,
     * and make sure to merge classes and inline styles.
     */
    public static function mergeAttributes(...$args): array
    {
        $attributes = [];

        foreach ($args as $moreAttributes) {
            if (! is_array($moreAttributes) && ! is_object($moreAttributes)) {
                continue;
            }

            foreach ($moreAttributes as $key => $value) {
                // class="foo bar"
                if ($key === 'class') {
                    if (! self::isStringable($value)) {
                        continue;
                    }

                    $attributes['class'] = trim(($attributes['class'] ?? '') . ' ' . $value);

                    continue;
                }

                // style="color: red;"
                if ($key === 'style') {
                    if (! self::isStringable($value)) {
                        continue;
                    }

                    $style = rtrim($attributes['style'] ?? '', '; ') . '; ' . rtrim($value, ';') . '; ';
                    $attributes['style'] = ltrim(trim($style), '; ');

                    continue;
                }

                $attributes[$key] = $value;
            }
        }

        return $attributes;
    }

    /**
     * Render an associative array of attributes
     * as a HTML string.
     */
    public static function renderAttributes(array $attrs): string
    {
        $attributes = [];

        // class="custom"
        foreach ($attrs as $name => $value) {
            if (! self::isStringable($value)) {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            $value = (string) $value;

            if ($value === '') {
                continue;
            }

            $escapedValue = htmlentities($value);

            $attributes[] = " {$name}=\"{$escapedValue}\"";
        }

        return join($attributes);
    }

    /**
     * Whether a value can be rendered into an attribute. Excludes null.
     */
    private static function isStringable($value): bool
    {
        return is_scalar($value) || $value instanceof \Stringable;
    }
}
