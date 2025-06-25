<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Link extends Mark
{
    public static $name = 'link';

    // Port of the DOMPurify helper used by Tiptap’s Link extension
    // https://github.com/ueberdosis/tiptap/blob/next/packages/extension-link/src/link.ts#L161
    const ATTR_WHITESPACE = '/[\x00-\x20\x{00A0}\x{1680}\x{180E}\x{2000}-\x{2029}\x{205F}\x{3000}]/u';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [
                'target' => '_blank',
                'rel' => 'noopener noreferrer nofollow',
            ],
            'allowedProtocols' => [
                'http', 'https', 'ftp', 'ftps', 'mailto', 'tel', 'callto', 'sms', 'cid', 'xmpp',
            ],
            'isAllowedUri' => fn ($uri) => $this->isAllowedUri($uri),
        ];
    }

    public function isAllowedUri($uri)
    {
        if ($uri === null || $uri === '') {
            return true;
        }

        $sanitised = preg_replace(self::ATTR_WHITESPACE, '', $uri);

        $pattern = '/^(?:(?:' . implode('|', array_map('preg_quote', $this->options['allowedProtocols']))
        . '):|[^a-z]|[a-z0-9+.\-]+(?:[^a-z+.\-:]|$))/i';

        return (bool) preg_match($pattern, $sanitised);
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'a[href]',
                'getAttrs' => function ($DOMNode) {
                    $href = $DOMNode->getAttribute('href');

                    if (
                        $href === '' ||
                        ! $this->options['isAllowedUri']($href)
                    ) {
                        return false;
                    }

                    return null;
                },
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'href' => [],
            'target' => [],
            'rel' => [],
            'class' => [],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        $isAllowed = $this->options['isAllowedUri']($HTMLAttributes['href'] ?? '');

        if (! $isAllowed) {
            $HTMLAttributes['href'] = '';
        }

        return [
            'a',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }
}
