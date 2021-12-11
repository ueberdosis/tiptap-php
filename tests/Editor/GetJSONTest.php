<?php

namespace Tiptap\Tests\Editor;

use PHPUnit\Framework\TestCase;
use Tiptap\Editor;

class GetJSONTest extends TestCase
{
    /** @test */
    public function json_output_is_correct()
    {
        $html = "<p>Example</p>";

        $json = '{"type":"doc","content":[{"type":"paragraph","content":[{"type":"text","text":"Example"}]}]}';

        $this->assertEquals($json, (new Editor)->setContent($html)->getJSON());
    }
}
