<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Helpers;

final class Factory
{
    private static $instance;
    /**
     * Returns a new index name based on the given `testName`.
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
        return sprintf(
            'php_%s_%s_%s',
            date('Y-M-d_H:i:s'),
            self::$instance,
            $name
        );

    }
}
