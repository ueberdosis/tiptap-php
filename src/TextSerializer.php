<?php

namespace Tiptap;

class TextSerializer
{
    protected $document;

    protected $schema;

    protected $configuration = [
        'blockSeparator' => "\n\n",
    ];

    public function __construct($schema, $configuration = [])
    {
        $this->schema = $schema;
        $this->configuration = array_merge($this->configuration, $configuration);
    }

    public function render(array $value)
    {
        $html = [];

        // transform document to object
        $this->document = json_decode(json_encode($value));

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $index => $node) {
            $html[] = $this->renderNode($node);
        }

        return join($this->configuration['blockSeparator'], $html);
    }

    private function renderNode($node): string
    {
        $text = [];

        if (isset($node->content)) {
            foreach ($node->content as $index => $nestedNode) {
                $text[] = $this->renderNode($nestedNode);
            }
        } elseif (isset($node->text)) {
            $text[] = htmlspecialchars($node->text, ENT_QUOTES, 'UTF-8');
        }

        return join($this->configuration['blockSeparator'], $text);
    }
}
