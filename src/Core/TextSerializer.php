<?php

namespace Tiptap\Core;

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

    public function process(array $value): string
    {
        $html = [];

        // transform document to object
        $this->document = json_decode(json_encode($value));

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $node) {
            $html[] = $this->renderNode($node);
        }

        return join($this->configuration['blockSeparator'], $html);
    }

    private function renderNode($node): string
    {
        $text = [];

        if (isset($node->content)) {
            foreach ($node->content as $nestedNode) {
                $text[] = $this->renderNode($nestedNode);
            }
        } elseif (isset($node->text)) {
            $text[] = htmlspecialchars($node->text, ENT_QUOTES, 'UTF-8');
        }

        return join($this->configuration['blockSeparator'], $text);
    }
}
