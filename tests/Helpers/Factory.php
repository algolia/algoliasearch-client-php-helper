<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Helpers;

use Algolia\AlgoliaSearch\Helper\SearchClient;

final class Factory
{
    private static $instance;

    private static $lang = 'php-helper';

    private $client;

    /**
     * Returns a new index name based on the given `name`.
     *
     * @param string $name
     *
     * @return string
     */
    public static function getIndexName($name)
    {
        if (!self::$instance) {
            self::$instance = getenv('TRAVIS') ? getenv('TRAVIS_JOB_NUMBER') : get_current_user();
            self::$lang = getenv('TRAVIS') ? 'TRAVIS_'.self::$lang : self::$lang;
            if (getenv('COMPOSER_FLAGS') === '--prefer-lowest') {
                self::$lang .= '_lowest';
            }
        }

        return sprintf('%s_%s_%s_%s', self::$lang, date('Y-M-d_H:i:s'), self::$instance, $name);
    }

    /**
     * Instantiate new Client.
     *
     * @param void
     *
     * @return \Algolia\AlgoliaSearch\Helper\SearchClient
     */
    public static function getClient()
    {
        return SearchClient::create(getenv('ALGOLIA_APPLICATION_ID_1'), getenv('ALGOLIA_ADMIN_KEY_1'));
    }

    /**
     * Create an object.
     *
     * @return array<string, int|string>
     */
    public static function makeObject()
    {
        $faker = \Faker\Factory::create();

        return [
            'objectID' => uniqid('php_helper_client_', true),
            ['name' => $faker->name],
            ['age' => $faker->randomDigitNotNull],
        ];
    }
}
