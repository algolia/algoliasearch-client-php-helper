<?php

namespace Algolia\AlgoliaSearch\Helper\Tests\Helpers;

final class Factory
{
    /**
     * Returns a new index name based on the given `testName`.
     *
     * @param string $testName
     *
     * @return string
     */
    public static function getIndexName($testName)
    {
        $phpversion = PHP_VERSION;

        date_default_timezone_set('UTC');

        $date = date('Y-m-d_H:i:s');

        $systemUsername = get_current_user();

        return $phpversion.'_'.$date.'_'.$systemUsername.'_'.$testName;
    }
}
