<?php

/**
 * This file is part of AlgoliaSearch Client PHP Helper.
 *
 * (c) Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper\Settings\SettingsAttribute;

use Algolia\AlgoliaSearch\Helper\Contracts\SettingContract;
use Algolia\AlgoliaSearch\Helper\Helpers\Str;

/*
 * @internal
 */
final class UnretrievableAttribute implements SettingContract
{
    /**
     * @var string[]
     */
    private static $unretrievableAttributesKeys = [
        '*password*',
        '*token*',
        '*secret*',
        '*hash*',
    ];

    /**
     * Checks if the given key/value is a 'UnretrieableAttribute'.
     *
     * @param string|int        $key
     * @param array|string|null $value
     * @param array             $unretrievableAttributes
     *
     * @return array
     */
    public function getValue($key, $value, $unretrievableAttributes)
    {
        if (is_string($key) && Str::is(self::$unretrievableAttributesKeys, $key)) {
            $unretrievableAttributes[] = $key;
        }

        return $unretrievableAttributes;
    }
}