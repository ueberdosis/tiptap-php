<?php

namespace Tiptap\Tests\JSONOutput\Nodes;


class CustomNodeTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function b_and_strong_get_rendered_correctly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<p>A custom node <span data-foo="bla bla" bar="nanana"></span> and some normal text.</p>';

        // $document = [
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

        // $this->assertEquals($document, $renderer->render($html));
    }
}
