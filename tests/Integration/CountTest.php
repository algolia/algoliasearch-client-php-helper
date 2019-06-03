<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\SearchClient;
use Algolia\AlgoliaSearch\Helper\Tests\Helpers\Factory;
use PHPUnit\Framework\TestCase;

final class CountTest extends TestCase
{
    /**
     * @var \Algolia\AlgoliaSearch\Helper\SearchIndex $index
     */
    private $index;

    /**
     * Called before every tests.
     *
     * @return void
     */
    public function setUp()
    {
        $this->index = SearchClient::get()->initIndex(Factory::getIndexName('index_exist'));
    }

    /**
     * Called after every tests.
     *
     * @return void
     */
    public function tearDown()
    {
        /* Delete index to clean up */
        $this->index->delete();
    }

    /**
     * Test if an index exist.
     *
     * @return void
     */
    public function testCountIndex()
    {
        /* Adding a object without object id to create the index */
        $obj1 = ['foo' => 'bar'];
        $response = $this->index->saveObject($obj1, ['autoGenerateObjectIDIfNotExist' => true]);

        /* Wait all collected task to terminate */
        $response->wait();

        /* Check if index exist */
        $response = $this->index->count();

        /* Assert value, should return true */
        self::assertEquals($response, 1);
    }
}