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
     * An array of \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodeCollection
     * and int as importance after each \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodeCollection.
     *
     * @var array<int, \Algolia\AlgoliaSearch\Helper\Splitters\HtmlSplitter\NodeCollection>
     */
    private $nodesImportance = [];

    /**
     * Holds the importance keyword.
     */
    const IMPORTANCE = 'importance';

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
     * @return array<int, array>
     */
    public function toArray()
    {
        $array = [];
        $object = [];
        foreach ($this->nodesImportance as $nodes) {
            foreach ($nodes as $node) {
                if ($node instanceof Node) {
                    $object[$node->getTag()] = $node->getContent();
                } else {
                    $object[self::IMPORTANCE] = $node;
                    $array[] = $object;
                    $object = [];
                }
            }
        }

        return $array;
    }
}
