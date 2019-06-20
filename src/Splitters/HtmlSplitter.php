<?php

/**
 * This file is part of AlgoliaSearch Client PHP Helper.
 *
 * (c) Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper\Splitters;

use Algolia\AlgoliaSearch\Helper\Contracts\SplitterContract;
use Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node;
use Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodeCollection;
use Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodesCollection;
use DOMXPath;
use DOMDocument;

final class HtmlSplitter implements SplitterContract
{
    /**
     * The list of html tags.
     *
     * @var string[]
     */
    private $tags = [
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'p',
    ];

    /**
     * Creates a new instance of the class.
     *
     * @param array|null $tags
     *
     * @return void
     */
    public function __construct($tags = null)
    {
        if (null !== $tags) {
            $this->tags = $tags;
        }
    }

    /**
     * Splits the given value.
     *
     * @param string $value
     *
     * @return array<int, array>
     */
    public function split($value)
    {
        $dom = new DOMDocument();
        //DOMDocument is only for HTML4, this exception is too avoid errors from HTML5
        try {
            $dom->loadHTML($value);
        } catch (\Exception $exception) {
            // @ignoreException
        }

        $xpath = new DOMXpath($dom);
        $xpathQuery = '//'.implode(' | //', $this->tags);
        $nodes = $xpath->query($xpathQuery);
        $nodesCollection = new NodesCollection();
        $nodeCollection = new NodeCollection($this->tags, $nodesCollection);

        foreach ($nodes as $node) {
            $nodeCollection->push(new Node($node->nodeName, $node->textContent));
        }

        return $nodesCollection->toArray();
    }
}
