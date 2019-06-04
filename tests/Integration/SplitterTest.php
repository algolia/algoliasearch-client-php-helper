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
}
