<?php

namespace Tiptap;

use Exception;

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
        if ($this->getContentType($value) === 'HTML') {
            $this->document = (new DOMParser)->render($value);
        } elseif ($this->getContentType($value) === 'Array') {
            $this->document = json_decode(json_encode($value), true);
        } elseif ($this->getContentType($value) === 'JSON') {
            $this->document = json_decode($value, true);
        }

        return $this;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getJSON()
    {
        return json_encode($this->document);
    }

    public function getHTML()
    {
        return (new DOMSerializer)->render($this->document);
    }

    public function sanitize($value)
    {
        if ($this->getContentType($value) === 'HTML') {
            return $this->setContent($value)->getHTML();
        } elseif ($this->getContentType($value) === 'Array') {
            return $this->setContent($value)->getDocument();
        } elseif ($this->getContentType($value) === 'JSON') {
            return $this->setContent($value)->getJSON();
        }
    }

    public function getContentType($value)
    {
        if (is_string($value)) {
            try {
                json_decode($value, true, 512, JSON_THROW_ON_ERROR);
                return 'JSON';
            } catch (Exception $exception) {
                return 'HTML';
            }
        }

        if (is_array($value)) {
            return 'Array';
        }

        throw new Exception('Unknown format passed to setContent().');
    }
}
