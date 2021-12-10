<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class ConfiguredMarksTest extends TestCase
{
    /** @test */
    public function bold_is_enabled_by_default()
    {
        $html = '<strong>Example Text</strong>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'bold',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function bold_is_enabled_explicitly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<strong>Example Text</strong>';

        // $document = [
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

        // $this->assertEquals($document, (new Renderer)->withMarks([
        //     \Tiptap\JSONOutput\Marks\Bold::class,
        // ])->render($html));
    }

    /** @test */
    public function all_marks_are_disabled()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<p><strong>Example Text</strong></p>';

        // $document = [
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

        // $this->assertEquals($document, (new Renderer)->withMarks([])->render($html));
    }

    /** @test */
    public function bold_is_replaced_with_a_custom_integration()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<p><b>Example Text</b></p>';

        // $document = [
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

        // $this->assertEquals($document, (new Renderer)->replaceMark(
        //     \Tiptap\JSONOutput\Marks\Bold::class,
        //     \Tiptap\Tests\JSONOutput\Marks\Custom\Bold::class
        // )->render($html));
    }
}
