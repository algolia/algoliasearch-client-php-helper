<?php

/**
 * This file is part of Algolia php-client-helper.
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
     * Instantiate \Algolia\AlgoliaSearch\Helper\SearchIndex.
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
