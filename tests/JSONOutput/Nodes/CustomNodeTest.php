<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Tests\JSONOutput\TestCase;

class CustomNodeTest extends TestCase
{
    /** @test */
    public function b_and_strong_get_rendered_correctly()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        // $html = '<p>A custom node <span data-foo="bla bla" bar="nanana"></span> and some normal text.</p>';

        // $json = [
        //     'type'    => 'doc',
        //     'content' => [
        //         [
        //             'type'    => 'paragraph',
        //             'content' => [
        //                 [
        //                     'type'  => 'text',
        //                     'text'  => 'A custom node ',
        //                 ],
        //                 [
        //                     'type' => 'custom',
        //                     'attrs' => [
        //                         'foo' => 'bla bla',
        //                         'bar' => 'nanana',
        //                     ],
        //                 ],
        //                 [
        //                     'type' => 'text',
        //                     'text' => ' and some normal text.',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ];

        // $renderer = (new Renderer())->addNode(Custom::class);

        // $this->assertEquals($json, $renderer->render($html));
    }
}
