<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class ConfiguredMarksTest extends TestCase
{
    /** @test */
    public function bold_is_enabled_by_default()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        // $html = '<strong>Example Text</strong>';

        // $json = [
        //     'type' => 'doc',
        //     'content' => [
        //         [
        //             'type' => 'text',
        //             'text' => 'Example Text',
        //             'marks' => [
        //                 [
        //                     'type' => 'bold',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function bold_is_enabled_explicitly()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        // $html = '<strong>Example Text</strong>';

        // $json = [
        //     'type' => 'doc',
        //     'content' => [
        //         [
        //             'type' => 'text',
        //             'text' => 'Example Text',
        //             'marks' => [
        //                 [
        //                     'type' => 'bold',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $this->assertEquals($json, (new Renderer)->withMarks([
        //     \Tiptap\JSONOutput\Marks\Bold::class,
        // ])->render($html));
    }

    /** @test */
    public function all_marks_are_disabled()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        // $html = '<p><strong>Example Text</strong></p>';

        // $json = [
        //     'type' => 'doc',
        //     'content' => [
        //         [
        //             'type' => 'paragraph',
        //             'content' => [
        //                 [
        //                     'type' => 'text',
        //                     'text' => 'Example Text',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $this->assertEquals($json, (new Renderer)->withMarks([])->render($html));
    }

    /** @test */
    public function bold_is_replaced_with_a_custom_integration()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        // $html = '<p><b>Example Text</b></p>';

        // $json = [
        //     'type' => 'doc',
        //     'content' => [
        //         [
        //             'type' => 'paragraph',
        //             'content' => [
        //                 [
        //                     'type' => 'text',
        //                     'text' => 'Example Text',
        //                     'marks' => [
        //                         [
        //                             'type' => 'bold',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $this->assertEquals($json, (new Renderer)->replaceMark(
        //     \Tiptap\JSONOutput\Marks\Bold::class,
        //     \Tiptap\Tests\JSONOutput\Marks\Custom\Bold::class
        // )->render($html));
    }
}
