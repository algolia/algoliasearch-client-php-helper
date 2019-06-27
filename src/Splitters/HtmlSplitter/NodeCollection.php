<?php

/**
 * This file is part of AlgoliaSearch Client PHP Helper.
 *
 * (c) Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter;

/**
 * @internal
 */
final class NodeCollection
{
    /**
     * Holds the paragraph tag.
     */
    const PARAGRAPH = 'p';
    /**
     * Collection of \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node.
     *
     * @var array<int, \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node>
     */
    private $nodes = [];

    /**
     * @var \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodesCollection
     */
    private $nodesCollection;

    /**
     * The list of html tags.
     *
     * @var array<int, string>
     */
    private $tags = [];

    /**
     * NodeCollection constructor.
     *
     * @param \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodesCollection $nodesCollection
     * @param null|array<int, string>                                              $tags
     */
    public function __construct(NodesCollection $nodesCollection, $tags = null)
    {
        if (null !== $tags) {
            $this->tags = $tags;
        }

        $this->nodesCollection = $nodesCollection;
    }

    /**
     * @return array<int, \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node>
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Add object to collection.
     *
     * @param \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node $node
     *
     * @return void
     */
    public function push(Node $node)
    {
        if (0 === $this->lengthNodes() || $this->findWeight($node) > $this->findWeight($this->last(0))) {
            $this->nodes[] = $node;
            $this->nodesCollection->push($this);
        } else {
            array_pop($this->nodes);
            $this->push($node);
        }
    }

    /**
     * Return the last element of the collection
     * Give integer as pointer from the end.
     *
     * @param int $position
     *
     * @return \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node
     */
    public function last($position)
    {
        return $this->nodes[$this->lengthNodes() - $position - 1];
    }

    /**
     * Importance formula.
     * Give integer from tags ranking.
     *
     * @param \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node $node
     *
     * @return int
     */
    public function importanceWeight(Node $node)
    {
        if (self::PARAGRAPH === $node->getTag()) {
            if (1 === $this->lengthNodes()) {
                return 0;
            }
            $object = $this->last(1);

            return (count($this->tags) - 1) + $this->findWeight($object);
        }

        return $this->findWeight($node);
    }

    /**
     * Find weight of current nodes.
     *
     * @param \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node $node
     *
     * @return int
     */
    private function findWeight(Node $node)
    {
        return (int) array_search($node->getTag(), $this->tags, true);
    }

    /**
     * Give the length of the collection.
     *
     * @return int
     */
    private function lengthNodes()
    {
        return count($this->nodes);
    }
}
