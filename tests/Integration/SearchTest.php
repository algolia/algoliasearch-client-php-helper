<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\SearchClient;
use Algolia\AlgoliaSearch\Response\MultiResponse;

class SearchTest extends AlgoliaIntegrationTestCase
{
    protected function setUp()
    {
        parent::setUp();
        static::$indexes['main'] = self::safeName('indexing');
    }

    public function testIndexNotExist()
    {
        /** @var \Algolia\AlgoliaSearch\Helper\SearchIndex $index */
        $index = SearchClient::get()->initIndex('IndexNotExisting');

        $response = $index->exist();

        self::assertEquals($response, false);
    }

    public function testIndexExist()
    {
        /** @var \Algolia\AlgoliaSearch\Helper\SearchIndex $index */
        $index = SearchClient::get()->initIndex(static::$indexes['main']);

        /* adding a object without object id to create the index */
        $obj1 = array('foo'=>'bar');
        $response = $index->saveObject($obj1, array('autoGenerateObjectIDIfNotExist' => true));

        /* Wait all collected task to terminate */
        $response->wait();

        $response = $index->exist();

        self::assertEquals($response, true);
    }
}
