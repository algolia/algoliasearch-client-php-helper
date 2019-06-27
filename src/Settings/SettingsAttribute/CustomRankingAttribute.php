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
final class CustomRankingAttribute implements SettingContract
{
    /**
     * @var string[]
     */
    private static $customRankingKeys = [
        '*ed_at',
        'count_*',
        '*_count',
        'number_*',
        '*_number',
    ];

    /**
     * Checks if the given key/value is a 'CustomRanking'.
     *
     * @param string            $key
     * @param array|string|null $value
     * @param array             $customRanking
     *
     * @return array
     */
    public function getValue($key, $value, $customRanking)
    {
        if (Str::is(self::$customRankingKeys, $key)) {
            $customRanking[] = "desc({$key})";
        }

        return $customRanking;
    }
}
