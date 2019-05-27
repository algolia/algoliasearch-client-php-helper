<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\SearchClient;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function testIndexNotExist()
    {
        /** @var \Algolia\AlgoliaSearch\Helper\SearchIndex $index */
        $index = SearchClient::get()->initIndex('testIndexNotExist');

        /* check if index exist */
        $response = $index->exist();

        /* Assert value, should return false */
        self::assertEquals($response, false);
    }

    public function testIndexExist()
    {
        /** @var \Algolia\AlgoliaSearch\Helper\SearchIndex $index */
        $index = SearchClient::get()->initIndex('main');

        /* adding a object without object id to create the index */
        $obj1 = array('foo' => 'bar');
        $response = $index->saveObject($obj1, array('autoGenerateObjectIDIfNotExist' => true));

        /* Wait all collected task to terminate */
        $response->wait();

        /* Check if index exist */
        $response = $index->exist();

        /* Assert value, should return true */
        self::assertEquals($response, true);

        /* Delete index */
        $index->delete();
    }
}
