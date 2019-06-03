<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\SearchClient;
use Algolia\AlgoliaSearch\Helper\Tests\Helpers\Factory;
use PHPUnit\Framework\TestCase;

final class CountTest extends TestCase
{
    /**
     * @var \Algolia\AlgoliaSearch\Helper\SearchIndex
     */
    private $index;

    /**
     * Called before every tests.
     */
    public function setUp()
    {
        $this->index = SearchClient::get()->initIndex(Factory::getIndexName('index_exist'));
    }

    /**
     * Called after every tests.
     */
    public function tearDown()
    {
        /* Delete index to clean up */
        $this->index->delete();
    }

    /**
     * Test if count return correct number of records.
     */
    public function testCountIndex()
    {
        /* Adding 1000 objects with object id */
        for ($i = 1; $i <= 1000; $i++) {
            $objects[$i] = Factory::createStubRecord($i);
        }

        $response = $this->index->saveObjects($objects);

        /* Wait all collected task to terminate */
        $response->wait();

        /* Check if index exist */
        $response = $this->index->count();

        /* Assert value, should return true */
        self::assertEquals($response, 1000);
    }
}
