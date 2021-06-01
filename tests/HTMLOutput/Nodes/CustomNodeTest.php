<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Tests\HTMLOutput\TestCase;

class CustomNodeTest extends TestCase
{
    /** @test */
    public function custom_node_gets_rendered_correctly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $json = [
        //     'type' => 'doc',
        //     'content' => [
        //         [
        //             'type' => 'div',
        //         ],
        //     ],
        // ];

        // $html = '<div></div>';

        // $renderer = new Renderer;
        // $renderer->addNode(Custom\Div::class);

        // $this->assertEquals($html, $renderer->render($json));
    }

    /** @test */
    public function multiple_custom_nodes_get_rendered_correctly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $json = [
        //     'type' => 'doc',
        //     'content' => [
        //         [
        //             'type' => 'div',
        //         ],
        //     ],
        // ];

        // $html = '<div></div>';

        // $renderer = new Renderer;
        // $renderer->addNodes([Custom\Div::class]);

        // $this->assertEquals($html, $renderer->render($json));
    }

    /** @test */
    public function custom_node_renders_with_correct_text()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $json = [
        //     'type' => 'doc',
        //     'content' => [
        //         [
        //             'type' => 'user',
        //             'attrs' => [
        //                 'id' => 123,
        //             ],
        //         ],
        //     ],
        // ];

        // $html = 'Foobar';

        // $renderer = new Renderer;
        // $renderer->addNode(Custom\User::class);

        // $this->assertEquals($html, $renderer->render($json));
    }
}
