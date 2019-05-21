<?php

namespace Algolia\AlgoliaSearch\Helper;

class SearchClient extends \Algolia\AlgoliaSearch\SearchClient
{
    public function initIndex($indexName)
    {
        return new SearchIndex($indexName, $this->api, $this->config);
    }
}