<?php

namespace Tiptap;

class Editor
{
    private $document;

    private $extensions;

    public function __construct($configuration = [])
    {
        $this->extensions = $configuration['extensions'] ?? [];
    }

    public function setJSON($value)
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        } elseif (is_array($value)) {
            $value = json_decode(json_encode($value), true);
        }

        $this->document = $value;

        return $this;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getHTML()
    {
        return (new DOMSerializer)->render($this->document);
    }
}
