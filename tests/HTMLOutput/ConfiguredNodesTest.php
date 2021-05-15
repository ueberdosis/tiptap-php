<?php

namespace Tiptap\Tests\HTMLOutput;

use Tiptap\Editor;

class ConfiguredNodesTest extends TestCase
{
    /** @test */
    public function paragraph_is_enabled_by_default()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
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

        // $html = '<p>Example Text</p>';

        // $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }

    /** @test */
    public function paragraph_is_enabled_explicitly()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
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

        // $html = '<p>Example Text</p>';

        // $this->assertEquals($html, (new Renderer)->withNodes([
        //     \Tiptap\HTMLOutput\Nodes\Paragraph::class,
        // ])->render($json));
    }

    /** @test */
    public function all_marks_are_disabled()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
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

        // $html = 'Example Text';

        // $this->assertEquals($html, (new Renderer)->withNodes([])->render($json));
    }

    /** @test */
    public function paragraph_is_replaced_with_a_custom_integration()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
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

        // $html = '<div>Example Text</div>';

        // $this->assertEquals($html, (new Renderer)->replaceNode(
        //     \Tiptap\HTMLOutput\Nodes\Paragraph::class,
        //     \Tiptap\Tests\HTMLOutput\Nodes\Custom\Paragraph::class
        // )->render($json));
    }
}
