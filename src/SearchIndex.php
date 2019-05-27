<?php

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
