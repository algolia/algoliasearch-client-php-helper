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
final class Node
{
    /**
     * Contains node name.
     *
     * @var string tag
     */
    private $tag;

    /**
     * Contains content of node.
     *
     * @var string
     */
    private $content;

    /**
     * Create a new instance of Node.
     *
     * @param string $tag
     * @param string $content
     */
    public function __construct($tag, $content)
    {
        $this->tag = $tag;
        $this->content = $this->cleanContent($content);
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Cleans the given content removing spaces.
     *
     * @param string $content
     *
     * @return string
     */
    private function cleanContent($content)
    {
        return trim((string) preg_replace('/\s+/', ' ', str_replace('\n', '', str_replace('’', '\'', $content))));
    }
}
