<?php

namespace Tiptap\Tests\JSONOutput\Marks\Custom;

use Tiptap\JSONOutput\Marks\Mark;

class Bold extends Mark
{
test('matching', function() {
        return $this->DOMNode->nodeName === 'strong' || $this->DOMNode->nodeName === 'b';
    }

test('data', function() {
        return [
            'type' => 'bold',
        ];
    }
}
