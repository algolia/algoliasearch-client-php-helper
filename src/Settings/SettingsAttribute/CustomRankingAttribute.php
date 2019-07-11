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

/**
 * @internal
 */
final class CustomRankingAttribute implements SettingContract
{
    /**
     * @var array<int, string>
     */
    private static $customRankingKeys = [
        '*ed_at',
        'count_*',
        '*_count',
        'number_*',
        '*_number',
    ];

    /**
     * {@inheritdoc}
     */
    public function getDetectedSettings($key, $value, $detectedSettings)
    {
        if (Str::is(self::$customRankingKeys, $key)) {
            $detectedSettings[] = "desc({$key})";
        }

        return $detectedSettings;
    }
}
