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

    public function setContent($value)
    {
        if (is_string($value)) {
            try {
                $this->document = json_decode($value, false, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {
                $this->document = (new DOMParser)->render($value);
            }
        } elseif (is_array($value)) {
            $this->document = json_decode(json_encode($value), false, 512, JSON_THROW_ON_ERROR);
        } else {
            // TODO: Throw exception, unkown format
        }


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
