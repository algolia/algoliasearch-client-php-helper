<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Helpers;

use Algolia\AlgoliaSearch\Helper\SearchClient;

final class Factory
{
    private static $instance;

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
        }

        return sprintf('php-helper_%s_%s_%s', date('Y-M-d_H:i:s'), self::$instance, $name);
    }

    /**
     * Returns a new client.
     *
     * @param void
     *
     * @return \Algolia\AlgoliaSearch\Helper\SearchClient
     */
    public static function getClient()
    {
        return SearchClient::create(getenv('ALGOLIA_APPLICATION_ID_1'), getenv('ALGOLIA_ADMIN_KEY_1'));
    }
}
