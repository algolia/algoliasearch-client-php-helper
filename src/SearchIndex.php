<?php

/**
 * This file is part of AlgoliaSearch Client PHP Helper.
 *
 * (c) Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper;

use Algolia\AlgoliaSearch\Exceptions\NotFoundException;

class SearchIndex extends \Algolia\AlgoliaSearch\SearchIndex
{
    /**
     * Check if the index exist.
     *
     * @return bool
     */
    public function exist()
    {
        try {
            $this->getSettings();

            return true;
        } catch (NotFoundException $exception) {
            return false;
        }
    }
}
