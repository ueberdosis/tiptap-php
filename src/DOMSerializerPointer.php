<?php declare(strict_types=1);

namespace Tiptap;

class DOMSerializerPointer
{
    public $element;
    public $content;

    public function __construct($element, $content = null)
    {
        $this->element = $element;
        $this->content = $content ?? $element;
    }
}
