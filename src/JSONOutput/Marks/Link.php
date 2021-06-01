<?php

namespace Tiptap\JSONOutput\Marks;

class Link extends Mark
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'a';
    }

    public function data($DOMNode)
    {
        $data = [
            'type' => 'link',
        ];

        $attrs = [];

        if ($target = $DOMNode->getAttribute('target')) {
            $attrs['target'] = $target;
        }

        if ($rel = $DOMNode->getAttribute('rel')) {
            $attrs['rel'] = $rel;
        }

        $attrs['href'] = $DOMNode->getAttribute('href');

        $data['attrs'] = $attrs;

        return $data;
    }
}
