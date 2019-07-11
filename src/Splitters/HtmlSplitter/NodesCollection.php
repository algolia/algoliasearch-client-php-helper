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
final class NodesCollection
{
    /**
     * Holds the importance keyword.
     */
    const IMPORTANCE = 'importance';

    /**
     * An array of \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodeCollection
     * and int as importance after each \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodeCollection.
     *
     * @var array<int, array<int, \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node> | array<string, int>>>
     */
    private $nodesImportance = [];

    /**
     * @var array<int, array<string, int|string>>
     */
    private $array = [];

    /**
     * @var array<string, int|string>
     */
    private $object = [];

    /**
     * Importance need to be add after to avoid polluted queue.
     *
     * @param \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodeCollection $nodes
     *
     * @return void
     */
    public function push(NodeCollection $nodes)
    {
        $this->nodesImportance[] = $nodes->getNodes();

        $this->nodesImportance[] = [self::IMPORTANCE => $nodes->importanceWeight($nodes->last(0))];
    }

    /**
     * Convert to array.
     *
     * @return array<int, array<string, int|string>>
     */
    public function toArray()
    {
        foreach ($this->nodesImportance as $nodes) {
            $this->sanitize($nodes);
        }

        return $this->array;
    }

    /**
     * Check the data before adding to the array and sanitize it.
     *
     * @param array<int, \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\Node>| array<string, int> $nodes
     *
     * @return void
     */
    private function sanitize($nodes)
    {
        foreach ($nodes as $node) {
            if ($node instanceof Node) {
                $this->object[$node->getTag()] = $node->getContent();
            } else {
                $this->object[self::IMPORTANCE] = $node;
                $this->array[] = $this->object;
                $this->object = [];
            }
        }
    }
}
