<?php

/**
 * This file is part of AlgoliaSearch Client PHP Helper.
 *
 * (c) Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper\Contracts;

/**
 * @internal
 */
interface SettingContract
{
    /**
     * Checks if the given key/value is a setting.
     *
     * @param int|string                            $key
     * @param null|array<int, string>|object|string $value
     * @param array<int, string>                    $detectedSettings
     *
     * @return array<int, int|string>
     */
    public function getDetectedSettings($key, $value, $detectedSettings);
}
