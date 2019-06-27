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
     * @param string            $key
     * @param array|string|null $value
     * @param array             $setting
     *
     * @return array
     */
    public function getValue($key, $value, $setting);
}
