<?php

/**
 * This file is part of Laravel.
 *
 * https://github.com/laravel/framework/blob/5.5/src/Illuminate/Support/Str.php
 *
 * It was modified by Algolia Team <contact@algolia.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Algolia\AlgoliaSearch\Helper\Helpers;

/**
 * @internal
 */
final class Str
{
    /**
     * Determine if a given string matches a given pattern.
     *
     * @param string|array $pattern
     * @param string|null  $value
     *
     * @return bool
     */
    public static function is($pattern, $value)
    {
        $patterns = is_array($pattern) ? $pattern : (array) $pattern;

        if (null === $value || 0 === count($patterns)) {
            return false;
        }
        foreach ($patterns as $patternValue) {
            // If the given value is an exact match we can of course return true right
            // from the beginning. Otherwise, we will translate asterisks and do an
            // actual pattern match against the two strings to see if they match.
            if ($patternValue === $value) {
                return true;
            }
            $patternValue = preg_quote($patternValue, '#');
            // Asterisks are translated into zero-or-more regular expression wildcards
            // to make it convenient to check if the strings starts with the given
            // pattern such as "library/*", making any string check convenient.
            $patternValue = str_replace('\*', '.*', $patternValue);
            if (1 === preg_match('#^'.$patternValue.'\z#u', $value)) {
                return true;
            }
        }

        return false;
    }
}
