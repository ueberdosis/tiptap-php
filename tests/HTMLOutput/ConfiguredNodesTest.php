<?php

namespace Tiptap\Tests\HTMLOutput;

use Tiptap\Editor;

class ConfiguredNodesTest extends TestCase
{
    /** @test */
    public function paragraph_is_enabled_by_default()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
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

        // $html = '<p>Example Text</p>';

        // $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }

    /** @test */
    public function paragraph_is_enabled_explicitly()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
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

        // $html = '<p>Example Text</p>';

        // $this->assertEquals($html, (new Renderer)->withNodes([
        //     \Tiptap\Nodes\Paragraph::class,
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

        // $html = 'Example Text';

        // $this->assertEquals($html, (new Renderer)->withNodes([])->render($document));
    }

    /** @test */
    public function paragraph_is_replaced_with_a_custom_integration()
    {
        $this->markTestSkipped('This test has not been implemented yet.');
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

        // $html = '<div>Example Text</div>';

        // $this->assertEquals($html, (new Renderer)->replaceNode(
        //     \Tiptap\Nodes\Paragraph::class,
        //     \Tiptap\Tests\Nodes\Custom\Paragraph::class
        // )->render($document));
    }
}
