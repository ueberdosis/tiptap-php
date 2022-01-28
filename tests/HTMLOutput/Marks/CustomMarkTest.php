<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Marks\Bold;
use Tiptap\Tests\HTMLOutput\TestCase;
use Tiptap\Tests\Marks\Custom\CustomMark;

class CustomBold extends Bold
{
    protected $markType = 'strong';
}

class CustomMarkTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function custom_mark_gets_rendered_correctly()
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
        //                     'type' => 'custom_mark',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $html = '<custom_mark>Example Text</custom_mark>';

        // $renderer = new Renderer();
        // $renderer->addMark(CustomMark::class);

        // $this->assertEquals($html, $renderer->render($document));
    }

    /** @test */
    public function multiple_custom_marks_get_rendered_correctly()
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
        //                     'type' => 'custom_mark',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $html = '<custom_mark>Example Text</custom_mark>';

        // $renderer = new Renderer();
        // $renderer->addMarks([CustomMark::class]);

        // $this->assertEquals($html, $renderer->render($document));
    }

    /** @test */
    public function example_for_overwriting_marks()
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
        //                     'type' => 'strong',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $html = '<strong>Example Text</strong>';

        // $renderer = new Renderer();

        // $renderer->replaceMark(Bold::class, CustomBold::class);

        // $this->assertEquals($html, $renderer->render($document));
    }
}
