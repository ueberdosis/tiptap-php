<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class ConfiguredNodesTest extends TestCase
{
    /** @test */
    public function paragraph_is_enabled_by_default()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<p>Example Text</p>';

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

        // $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function paragraph_is_enabled_explicitly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<p>Example Text</p>';

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

        // $this->assertEquals($document, (new Renderer)->withNodes([
        //     \Tiptap\JSONOutput\Nodes\Text::class,
        //     \Tiptap\JSONOutput\Nodes\Paragraph::class,
        // ])->render($html));
    }

    /** @test */
    public function all_nodes_are_disabled()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<p>Example Text</p>';

        // $document = [
        //     'type' => 'doc',
        //     'content' => [],
        // ];

        // $this->assertEquals($document, (new Renderer)->withNodes([])->render($html));
    }

    /** @test */
    public function paragraph_is_replaced_with_a_custom_integration()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
        // $html = '<div>Example Text</div>';

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

        // $this->assertEquals($document, (new Renderer)->replaceNode(
        //     \Tiptap\JSONOutput\Nodes\Paragraph::class,
        //     \Tiptap\Tests\JSONOutput\Nodes\Custom\Paragraph::class
        // )->render($html));
    }
}
