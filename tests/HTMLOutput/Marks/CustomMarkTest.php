<?php

namespace Tiptap\Tests\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Marks\Bold;
use Tiptap\Tests\HTMLOutput\Marks\Custom\CustomMark;
use Tiptap\Tests\HTMLOutput\TestCase;

class CustomBold extends Bold
{
    protected $markType = 'strong';
}

class CustomMarkTest extends TestCase
{
    /** @test */
    public function custom_mark_gets_rendered_correctly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $json = [
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

        // $this->assertEquals($html, $renderer->render($json));
    }

    /** @test */
    public function multiple_custom_marks_get_rendered_correctly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $json = [
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

        // $this->assertEquals($html, $renderer->render($json));
    }

    /** @test */
    public function example_for_overwriting_marks()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $json = [
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

        // $this->assertEquals($html, $renderer->render($json));
    }
}
