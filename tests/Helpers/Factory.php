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

    /**
     * Create random record.
     *
     * @param bool $objectID
     *
     * @return array
     */
    public static function createStubRecord($objectID = false)
    {
        $faker = \Faker\Factory::create();
        $record = ['name' => $faker->name];
        if (null === $objectID) {
            $record['objectID'] = uniqid('php_client_', true);
        } elseif (false !== $objectID) {
            $record['objectID'] = $objectID;
        }

        return $record;
    }
}
