<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\SearchClient;
use Algolia\AlgoliaSearch\Helper\Tests\Helpers\Factory;
use PHPUnit\Framework\TestCase;

final class SearchTest extends TestCase
{
    /**
     * @var \Algolia\AlgoliaSearch\Helper\SearchIndex
     */
    private $index;

    /**
     * Called before every tests.
     *
     * @return void
     */
    public function setUp()
    {
        $client = Factory::getClient();
        $this->index = $client->initIndex(Factory::getIndexName('indexExist'));
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
     * Test if an index not exist.
     *
     * @return void
     */
    public function testIndexNotExist()
    {
        /* Check if index exist */
        $response = $this->index->exist();

        /* Assert value, should return false */
        self::assertEquals($response, false);
    }

    /**
     * Test if an index exist.
     *
     * @return void
     */
    public function testIndexExist()
    {
        /* Adding a object without object id to create the index */
        $obj1 = ['foo' => 'bar'];
        $response = $this->index->saveObject($obj1, ['autoGenerateObjectIDIfNotExist' => true]);

        /* Wait all collected task to terminate */
        $response->wait();

        /* Check if index exist */
        $response = $this->index->exist();

        /* Assert value, should return true */
        self::assertEquals($response, true);

        /* Delete index */
        $this->index->delete();
    }
}
