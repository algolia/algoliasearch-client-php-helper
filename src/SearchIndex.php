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
        } catch (NotFoundException $exception) {
            return false;
        }

        return true;
    }

    /**
     * Count number of records inside an index.
     *
     * @return int
     */
    public function count()
    {
        $response = $this->search('');

        return $response['nbHits'];
    }
}
