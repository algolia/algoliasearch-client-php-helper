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

final class SearchIndex extends \Algolia\AlgoliaSearch\SearchIndex
{
    /**
     * Count number of records of the index.
     *
     * @return int
     */
    public function count()
    {
        $response = $this->search('');

        return $response['nbHits'];
    }
}
