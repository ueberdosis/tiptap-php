<?php

namespace Tiptap;

class TextSerializer
{
    protected object $document;

    protected Schema $schema;

    protected array $configuration = [
        'blockSeparator' => "\n\n",
    ];

    public function __construct(Schema $schema, array $configuration = [])
    {
        $this->schema = $schema;
        $this->configuration = array_merge($this->configuration, $configuration);
    }

    public function render(array $value): string
    {
        $html = [];

        // transform document to object
        $this->document = json_decode(json_encode($value));

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $node) {
            $html[] = $this->renderNode($node);
        }

        return implode($this->configuration['blockSeparator'], $html);
    }

    private function renderNode($node): string
    {
        $text = [];

        if (isset($node->content)) {
            foreach ($node->content as $nestedNode) {
                $text[] = $this->renderNode($nestedNode);
            }
        } elseif (isset($node->text)) {
            $text[] = htmlspecialchars($node->text, ENT_QUOTES);
        }

        return implode($this->configuration['blockSeparator'], $text);
    }
}
