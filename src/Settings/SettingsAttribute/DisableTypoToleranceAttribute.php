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
final class DisableTypoToleranceAttribute implements SettingContract
{
    /**
     * @var string[]
     */
    private static $disableTypoToleranceOnAttributesKeys = [
        'slug',
        '*_slug',
        'slug_*',
        '*code*',
        '*sku*',
        '*reference*',
    ];

    /**
     * Checks if the given key/value is a 'disableTypoToleranceOnAttributes'.
     *
     * @param string            $key
     * @param array|string|null $value
     * @param array             $disableTypoToleranceOnAttributes
     *
     * @return array
     */
    public function getValue($key, $value, $disableTypoToleranceOnAttributes)
    {
        if (Str::is(self::$disableTypoToleranceOnAttributesKeys, $key)) {
            $disableTypoToleranceOnAttributes[] = $key;
        }

        return $disableTypoToleranceOnAttributes;
    }
}
