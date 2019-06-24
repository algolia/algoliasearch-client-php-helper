<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\Settings\SettingsFactory;
use Algolia\AlgoliaSearch\Helper\Tests\Helpers\Factory;
use PHPUnit\Framework\TestCase;

final class GenerateSettingsTest extends TestCase
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
    public function testEmptyArray()
    {
        $array = [];
        $settings = SettingsFactory::create($array);
        $this->index->setSettings($settings)
            ->wait();
        $settings = $this->index->getSettings();

        self::assertEmpty($settings['attributesForFaceting']);
        self::assertEmpty($settings['customRanking']);
        self::assertEmpty($settings['disableTypoToleranceOnAttributes']);
        self::assertArrayNotHasKey('searchableAttributes', $settings);
        self::assertEmpty($settings['unretrievableAttributes']);
    }

    /**
     * @return void
     */
    public function testAttributeForFaceting()
    {
        $array = [
            'category_name' => 'Foo',
            'list_name' => 'Bar',
            'country_name' => 'Baz',
            'city_name' => 'Bam',
            'type_name' => 'Bat',
        ];

        $settings = SettingsFactory::create($array);
        $this->index->setSettings($settings)
            ->wait();
        $settings = $this->index->getSettings();

        self::assertEquals(array_keys($array), $settings['attributesForFaceting']);
    }

    /**
     * @return void
     */
    public function testCustomRankingAttribute()
    {
        $array = [
            'created_at' => 'Foo',
            'count_likes' => 'Bar',
            'likes_count' => 'Baz',
            'number_car' => 'Bam',
            'car_number' => 'Bat',
        ];

        $settings = SettingsFactory::create($array);
        $this->index->setSettings($settings)
            ->wait();
        $settings = $this->index->getSettings();
        $array = [
            'desc(created_at)' => 'Foo',
            'desc(count_likes)' => 'Bar',
            'desc(likes_count)' => 'Baz',
            'desc(number_car)' => 'Bam',
            'desc(car_number)' => 'Bat',
        ];
        self::assertEquals(array_keys($array), $settings['customRanking']);
    }

    /**
     * @return void
     */
    public function testdisableTypoToleranceOnAttributesKeys()
    {
        $array = [
            'slug' => 'Foo',
            '*_slug' => 'Bar',
            'slug_*' => 'Baz',
            '*code*' => 'Bam',
            '*sku*' => 'Bat',
            '*reference*' => 'Bap',
        ];

        $settings = SettingsFactory::create($array);
        $this->index->setSettings($settings)
            ->wait();
        $settings = $this->index->getSettings();
        self::assertEquals(array_keys($array), $settings['disableTypoToleranceOnAttributes']);
    }

    /**
     * @return void
     */
    public function testSearchableAttribute()
    {
        $array = [
            'Foo' => 'Foo',
            'id' => 'id',
            '*_id' => '*_id',
            'id_*' => 'id_*',
            '*ed_at' => '*ed_at',
            '*_count' => '*_count',
            'count_*' => 'count_*',
            'number_*' => 'number_*',
            '*_number' => '*_number',
            '*image*' => '*image*',
            '*url*' => '*url*',
            '*link*' => '*link*',
            '*password*' => '*password*',
            '*token*' => '*token*',
            '*hash*' => '*hash*',
            'Bar' => 'http://*',
            'Baz' => 'https://*',
        ];
        $settings = SettingsFactory::create($array);
        $this->index->setSettings($settings)
            ->wait();
        $settings = $this->index->getSettings();

        self::assertEquals([0 => 'Foo'], $settings['searchableAttributes']);
    }

    /**
     * @return void
     */
    public function testUnretrievableAttribute()
    {
        $array = [
            '*password*' => 'Foo',
            '*token*' => 'Bar',
            '*secret*' => 'Baz',
            '*hash*' => 'Bam',
        ];

        $settings = SettingsFactory::create($array);
        $this->index->setSettings($settings)
                    ->wait();
        $settings = $this->index->getSettings();

        self::assertEquals(array_keys($array), $settings['unretrievableAttributes']);
    }
}