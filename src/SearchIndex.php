<?php

namespace Algolia\AlgoliaSearch\Helper;

use Algolia\AlgoliaSearch\Exceptions\NotFoundException;

class SearchIndex extends \Algolia\AlgoliaSearch\SearchIndex
{
    public function exist(){
        try {
            $this->getSettings();
            $response = true ;
        }catch (NotFoundException $exception){
            $response = false;
        }
        return $response;
    }
}