<?php declare(strict_types=1);

namespace Tiptap;

use Exception;
use Tiptap\Extensions\StarterKit;

class Editor
{
    protected array $document;

    public Schema $schema;

    public array $configuration = [];

    public function __construct(array $configuration = [])
    {
        if (! isset($configuration['extensions'])) {
            $configuration['extensions'] = [
                new StarterKit,
            ];
        }

        $this->configuration = array_merge_recursive($this->configuration, $configuration);
        $this->schema = Schema::from($this->configuration['extensions']);

        if (isset($configuration['content'])) {
            $this->setContent($configuration['content']);
        }
    }

    public function setContent($value): self
    {
        if ($this->getContentType($value) === 'HTML') {
            $this->document = (new DOMParser($this->schema))->render($value);
        } elseif ($this->getContentType($value) === 'Array') {
            $this->document = json_decode(json_encode($value), true);
        } elseif ($this->getContentType($value) === 'JSON') {
            $this->document = json_decode($value, true);
        }

        $this->document = $this->schema::apply($this->document);

        return $this;
    }

    public function getDocument(): array
    {
        return $this->document;
    }

    public function getJSON()
    {
        return json_encode($this->document);
    }

    public function getText($configuration = []): string
    {
        return (new TextSerializer($this->schema, $configuration))->render($this->document);
    }

    public function getHTML(): string
    {
        return (new DOMSerializer($this->schema))->render($this->document);
    }

    /**
     * @return array|false|string
     * @throws Exception
     */
    public function sanitize($value)
    {
        if ($this->getContentType($value) === 'HTML') {
            return $this->setContent($value)->getHTML();
        } elseif ($this->getContentType($value) === 'Array') {
            return $this->setContent($value)->getDocument();
        }

        return $this->setContent($value)->getJSON();
    }

    public function getContentType($value): string
    {
        if (is_string($value)) {
            try {
                /**
                 * @psalm-suppress UnusedFunctionCall
                 */
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

    public function descendants($closure): self
    {
        // Transform the document to an object
        $node = json_decode(json_encode($this->document));

        $this->loopThroughNodes($node, $closure);

        // Transform the object to a document
        $this->setContent(json_decode(json_encode($node), true));

        return $this;
    }

    private function loopThroughNodes(&$node, $closure)
    {
        if ($node->type === 'text') {
            return;
        }

        $closure($node);

        if (! isset($node->content)) {
            return;
        }

        $content = is_array($node->content) ? $node->content : [];

        foreach ($content as $child) {
            $this->loopThroughNodes($child, $closure);
        }
    }
}
