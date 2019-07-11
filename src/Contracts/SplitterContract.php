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

interface SplitterContract
{
    /**
     * Splits the given value.
     *
     * @param string $value
     *
     * @return array<int, array>
     */
    public function split($value);
}
