<?php

/**
 * This file is part of AlgoliaSearch Client PHP Helper.
 *
 * (c) Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper\Settings;

use Algolia\AlgoliaSearch\Helper\Settings\SettingsAttribute\AttributeForFaceting;
use Algolia\AlgoliaSearch\Helper\Settings\SettingsAttribute\CustomRankingAttribute;
use Algolia\AlgoliaSearch\Helper\Settings\SettingsAttribute\DisableTypoToleranceAttribute;
use Algolia\AlgoliaSearch\Helper\Settings\SettingsAttribute\SearchableAttribute;
use Algolia\AlgoliaSearch\Helper\Settings\SettingsAttribute\UnretrievableAttribute;

/**
 * @internal
 */
final class SettingsFactory
{
    /**
     * @var string[]
     */
    private static $settings = [
        'searchableAttributes' => SearchableAttribute::class,
        'attributesForFaceting' => AttributeForFaceting::class,
        'customRanking' => CustomRankingAttribute::class,
        'disableTypoToleranceOnAttributes' => DisableTypoToleranceAttribute::class,
        'unretrievableAttributes' => UnretrievableAttribute::class,
    ];

    /**
     * Creates settings for the given model.
     *
     * @param array $model
     *
     * @return array
     */
    public static function create($model)
    {
        $detectedSettings = array_fill_keys(array_keys(self::$settings), []);
        foreach ($model as $key => $value) {
            $key = (string) $key;
            foreach (self::$settings as $setting => $settingClass) {
                $detectedSettings[$setting] = (new $settingClass())->getValue($key, $value, $detectedSettings[$setting]);
            }
        }

        return $detectedSettings;
    }
}
