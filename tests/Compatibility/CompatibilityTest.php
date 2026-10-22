<?php

use Tiptap\Editor;
use Tiptap\Extensions\Color;
use Tiptap\Extensions\FontFamily;
use Tiptap\Extensions\StarterKit;
use Tiptap\Extensions\TextAlign;
use Tiptap\Marks\Highlight;
use Tiptap\Marks\Link;
use Tiptap\Marks\Subscript;
use Tiptap\Marks\Superscript;
use Tiptap\Marks\TextStyle;
use Tiptap\Marks\Underline;
use Tiptap\Nodes\Details;
use Tiptap\Nodes\DetailsContent;
use Tiptap\Nodes\DetailsSummary;
use Tiptap\Nodes\Image;
use Tiptap\Nodes\Mention;
use Tiptap\Nodes\Table;
use Tiptap\Nodes\TableCell;
use Tiptap\Nodes\TableHeader;
use Tiptap\Nodes\TableRow;
use Tiptap\Nodes\TaskItem;
use Tiptap\Nodes\TaskList;

function compatibilityExtensions(string $profile): array
{
    $starterKit = new StarterKit;

    return match ($profile) {
        'starterKit' => [$starterKit],
        'marks' => [
            $starterKit,
            new Link,
            new Underline,
            new Highlight(['multicolor' => true]),
            new Subscript,
            new Superscript,
        ],
        'styles' => [
            $starterKit,
            new TextStyle,
            new Color,
            new FontFamily,
            new TextAlign(['types' => ['heading', 'paragraph']]),
        ],
        'image' => [$starterKit, new Image],
        'mention' => [$starterKit, new Mention],
        'taskList' => [$starterKit, new TaskList, new TaskItem],
        'table' => [$starterKit, new Table, new TableRow, new TableHeader, new TableCell],
        'details' => [
            $starterKit,
            new Details(['persist' => true]),
            new DetailsSummary,
            new DetailsContent,
        ],
        default => throw new InvalidArgumentException("Unknown extension profile: {$profile}"),
    };
}

function compatibilityEditor(string $profile): Editor
{
    return new Editor(['extensions' => compatibilityExtensions($profile)]);
}

function callTiptapJs(string $operation, string $profile, $value)
{
    $command = ['node', __DIR__ . '/js/bridge.mjs'];
    $pipes = [];
    $process = proc_open($command, [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ], $pipes, dirname(__DIR__, 2));

    if (! is_resource($process)) {
        throw new RuntimeException('Unable to start the Tiptap JS bridge.');
    }

    fwrite($pipes[0], json_encode([
        'operation' => $operation,
        'profile' => $profile,
        'value' => $value,
    ], JSON_THROW_ON_ERROR));
    fclose($pipes[0]);

    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $exitCode = proc_close($process);

    if ($exitCode !== 0) {
        throw new RuntimeException("Tiptap JS bridge failed:\n{$stderr}");
    }

    return json_decode($stdout, true, 512, JSON_THROW_ON_ERROR);
}

function canonicalCompatibilityDocument(array $value): array
{
    if (array_is_list($value)) {
        return array_map(
            fn ($item) => is_array($item) ? canonicalCompatibilityDocument($item) : $item,
            $value,
        );
    }

    foreach ($value as $key => $item) {
        if (is_array($item)) {
            $value[$key] = canonicalCompatibilityDocument($item);
        }
    }

    if (isset($value['attrs']) && is_array($value['attrs'])) {
        $value['attrs'] = array_filter($value['attrs'], fn ($attribute) => $attribute !== null);
        $type = $value['type'] ?? null;

        if ($type === 'orderedList' && ($value['attrs']['start'] ?? null) === 1) {
            unset($value['attrs']['start']);
        }
        if ($type === 'taskItem' && ($value['attrs']['checked'] ?? null) === false) {
            unset($value['attrs']['checked']);
        }
        if (in_array($type, ['tableCell', 'tableHeader'], true)) {
            foreach (['colspan', 'rowspan'] as $attribute) {
                if (($value['attrs'][$attribute] ?? null) === 1) {
                    unset($value['attrs'][$attribute]);
                }
            }
        }
        if ($type === 'mention' && ($value['attrs']['mentionSuggestionChar'] ?? null) === '@') {
            unset($value['attrs']['mentionSuggestionChar']);
        }
        if ($value['attrs'] === []) {
            unset($value['attrs']);
        }
    }

    ksort($value);

    return $value;
}

dataset('compatibility fixtures', function () {
    foreach (glob(__DIR__ . '/fixtures/*.json') as $path) {
        $fixture = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        yield $fixture['name'] => [$fixture];
    }
});

test('PHP and JS parse HTML to the same document', function (array $fixture) {
    $expected = canonicalCompatibilityDocument($fixture['document']);
    $phpDocument = compatibilityEditor($fixture['profile'])
        ->setContent($fixture['html'])
        ->getDocument();
    $jsDocument = callTiptapJs('parse', $fixture['profile'], $fixture['html']);

    expect(canonicalCompatibilityDocument($phpDocument))->toEqual($expected)
        ->and(canonicalCompatibilityDocument($jsDocument))->toEqual($expected);
})->with('compatibility fixtures');

test('PHP-rendered HTML can be parsed by JS', function (array $fixture) {
    $expected = canonicalCompatibilityDocument($fixture['document']);
    $html = compatibilityEditor($fixture['profile'])
        ->setContent($fixture['document'])
        ->getHTML();

    expect(canonicalCompatibilityDocument(callTiptapJs('parse', $fixture['profile'], $html)))
        ->toEqual($expected);
})->with('compatibility fixtures');

test('JS-rendered HTML can be parsed by PHP', function (array $fixture) {
    $expected = canonicalCompatibilityDocument($fixture['document']);
    $html = callTiptapJs('render', $fixture['profile'], $fixture['document']);
    $document = compatibilityEditor($fixture['profile'])
        ->setContent($html)
        ->getDocument();

    expect(canonicalCompatibilityDocument($document))->toEqual($expected);
})->with('compatibility fixtures');
