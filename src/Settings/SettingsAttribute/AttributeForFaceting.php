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
final class AttributeForFaceting implements SettingContract
{
    /**
     * @var string[]
     */
    private static $attributesForFacetingKeys = [
        '*category*',
        '*list*',
        '*country*',
        '*city*',
        '*type*',
    ];

    /**
     * Checks if the given key/value is a 'attributesForFaceting'.
     *
     * @param string            $key
     * @param array|string|null $value
     * @param array             $attributesForFaceting
     *
     * @return array
     */
    public function getValue($key, $value, $attributesForFaceting)
    {
        if (Str::is(self::$attributesForFacetingKeys, $key)) {
            $attributesForFaceting[] = $key;
        }

        return $attributesForFaceting;
    }
}
