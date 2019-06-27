<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Integration;

use Algolia\AlgoliaSearch\Helper\Settings\SettingsFactory;
use Algolia\AlgoliaSearch\Helper\Tests\Helpers\Factory;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
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
        self::assertNull($settings['attributesForFaceting']);
        self::assertNull($settings['customRanking']);
        self::assertArrayNotHasKey('disableTypoToleranceOnAttributes', $settings);
        self::assertArrayNotHasKey('searchableAttributes', $settings);
        self::assertNull($settings['unretrievableAttributes']);
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
            'name_slug' => 'Bar',
            'slug_name' => 'Baz',
            'code_name' => 'Bam',
            'sku' => 'Bat',
            'reference_name' => 'Bap',
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
            'name_id' => 'name_id',
            'id_name' => 'id_name',
            'created_at' => 'created_at',
            'name_count' => 'name_count',
            'count_name_' => 'count_name_',
            'number_name_' => 'number_name_',
            'name__number' => 'name__number',
            'name_image_' => 'name_image',
            'name_url_' => 'name_url',
            'name_link_' => 'name_link',
            'name_password' => 'name_password',
            'name_token' => 'name_token',
            'name_hash' => 'name_hash',
            'Bar' => 'http://baz',
            'Baz' => 'https://baz',
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
            'name_password' => 'Foo',
            'name_token' => 'Bar',
            'name_secret' => 'Baz',
            'name_hash' => 'Bam',
        ];

        $settings = SettingsFactory::create($array);
        $this->index->setSettings($settings)
            ->wait();

        $settings = $this->index->getSettings();

        self::assertEquals(array_keys($array), $settings['unretrievableAttributes']);
    }
}
