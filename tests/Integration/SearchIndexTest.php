<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\Tests\Helpers\Factory;
use PHPUnit\Framework\TestCase;

final class SearchIndexTest extends TestCase
{
    /**
     * @var \Algolia\AlgoliaSearch\Helper\SearchIndex
     */
    private $index;

    /**
     * @return void
     */
    public function setUp()
    {
        $client = Factory::getClient();

        $this->index = $client->initIndex(Factory::getIndexName($this->getName()));
    }

    /**
     * @return void
     */
    public function tearDown()
    {
        $this->index->delete();
    }

    /**
     * @return void
     */
    public function testExist()
    {
        self::assertFalse($this->index->exist());

        $obj = ['foo' => 'bar'];

        $this->index
            ->saveObject($obj, ['autoGenerateObjectIDIfNotExist' => true])
            ->wait();

        self::assertTrue($this->index->exist());
    }

    /**
     * @return void
     */
    public function testCount()
    {
        for ($i = 1; $i <= 1000; $i++) {
            $objects[] = Factory::makeObject();
        }

        $this->index
            ->saveObjects($objects)
            ->wait();

        self::assertEquals($this->index->count(), 1000);
    }
}
