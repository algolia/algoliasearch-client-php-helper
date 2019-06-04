<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

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
        static::assertEquals($expectedRecords, $splitter->split(null, $file));
    }
}