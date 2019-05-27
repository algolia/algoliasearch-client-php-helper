<?php

namespace Algolia\AlgoliaSearch\Helper;

use Algolia\AlgoliaSearch\Exceptions\NotFoundException;

class SearchIndex extends \Algolia\AlgoliaSearch\SearchIndex
{
    /**
     * Check if the index exist.
     *
     * @return bool $response
     */
    public function exist()
    {
        try {
            $this->getSettings();
            $response = true;
        } catch (NotFoundException $exception) {
            $response = false;
        }

        return $response;
    }
}
