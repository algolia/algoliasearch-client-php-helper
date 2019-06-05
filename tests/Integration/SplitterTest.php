<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter;
use PHPUnit\Framework\TestCase;

final class SplitterTest extends TestCase
{
    /**
     * @return void
     */
    public function testHtmlPageCanBeSplitted()
    {
        $file = file_get_contents(__DIR__.'/content/article.html');

        $expectedRecords = require __DIR__.'/content/article.php';

        $splitter = new HtmlSplitter();

        static::assertEquals($expectedRecords, $splitter->split((string) $file));
    }

    /**
     * @return void
     */
    public function testHtmlPageWithNoStandardCanBeSplitted()
    {
        $file = file_get_contents(__DIR__.'/content/article2.html');
        $expectedRecords = require __DIR__.'/content/article2.php';
        $splitter = new HtmlSplitter();
        static::assertEquals($expectedRecords, $splitter->split((string) $file));
    }

    /**
     * @return void
     */
    public function testHtmlPageWithWrongCloseTagCanBeSplitted()
    {
        $content = implode('', [
            '<h1>Hello Foo!</h2>',
        ]);

        $expectedRecords = [['h1' => 'Hello Foo!', 'importance' => 0]];

        $splitter = new HtmlSplitter();

        static::assertEquals($expectedRecords, $splitter->split($content));
    }

    /**
     * @return void
     */
    public function testHtmlPageWithDifferentParents()
    {
        $content = implode('', [
            '<h1>Hello Foo!</h1>',
            '<p>Hello Bar!</p>',
            '<p>Hello Baz!</p>',
        ]);

        $expectedRecords = [
            ['h1' => 'Hello Foo!', 'importance' => 0],
            ['h1' => 'Hello Foo!', 'p' => 'Hello Bar!', 'importance' => 6],
            ['h1' => 'Hello Foo!', 'p' => 'Hello Baz!', 'importance' => 6],
        ];

        $splitter = new HtmlSplitter();
        static::assertEquals($expectedRecords, $splitter->split($content));
    }

    /**
     * @return void
     */
    public function testHtmlPageWithSingleParagraph()
    {
        $content = implode('', [
            '<p>Hello Foo!</p>',
        ]);

        $expectedRecords = [
            ['p' => 'Hello Foo!', 'importance' => 0],
        ];

        $splitter = new HtmlSplitter();
        static::assertEquals($expectedRecords, $splitter->split($content));
    }

    /**
     * @return void
     */
    public function testHtmlPageWithMultipleParagraph()
    {
        $content = implode('', [
            '<p>Hello Foo!</p>',
            '<p>Hello Bar!</p>',
        ]);

        $expectedRecords = [
            ['p' => 'Hello Foo!', 'importance' => 0],
            ['p' => 'Hello Bar!', 'importance' => 0],
        ];

        $splitter = new HtmlSplitter();
        static::assertEquals($expectedRecords, $splitter->split($content));
    }

    /**
     * @return void
     */
    public function testHtmlPageWithEmptyContent()
    {
        $content = implode('', [
            '',
        ]);

        $expectedRecords = [];

        $splitter = new HtmlSplitter();

        static::assertEquals($expectedRecords, $splitter->split($content));
    }
}
