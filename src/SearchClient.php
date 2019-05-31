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

class SearchClient extends \Algolia\AlgoliaSearch\SearchClient
{
    /**
     * Creates a new instance of the Search Index.
     *
     * @param string $indexName
     *
     * @return \Algolia\AlgoliaSearch\Helper\SearchIndex
     */
    public function initIndex($indexName)
    {
        return new SearchIndex($indexName, $this->api, $this->config);
    }
}
