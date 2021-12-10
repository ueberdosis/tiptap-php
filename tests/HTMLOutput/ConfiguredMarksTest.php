<?php

namespace Tiptap\Tests\HTMLOutput;

use Tiptap\Editor;

class ConfiguredMarksTest extends TestCase
{
    /** @test */
    public function bold_is_enabled_by_default()
    {
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

        $html = '<strong>Example Text</strong>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }

    /** @test */
    public function bold_is_enabled_explicitly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
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

        // $html = '<strong>Example Text</strong>';

        // $this->assertEquals($html, (new Renderer)->withMarks([
        //     \Tiptap\Marks\Bold::class,
        // ])->render($document));
    }

    /** @test */
    public function all_marks_are_disabled()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
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

        // $html = 'Example Text';

        // $this->assertEquals($html, (new Renderer)->withMarks([])->render($document));
    }

    /** @test */
    public function bold_is_replaced_with_a_custom_integration()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
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

        // $html = '<b>Example Text</b>';

        // $this->assertEquals($html, (new Renderer)->replaceMark(
        //     \Tiptap\Marks\Bold::class,
        //     \Tiptap\Tests\Marks\Custom\Bold::class
        // )->render($document));
    }
}
