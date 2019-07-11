<?php

/**
 * This file is part of Laravel.
 *
 * https://github.com/laravel/framework/blob/master/src/Illuminate/Support/Str.php
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
     * @param array<int, string>|string $pattern
     * @param null|int|string           $value
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
            if ($patternValue === $value) {
                return true;
            }
            $patternValue = preg_quote($patternValue, '#');
            $patternValue = str_replace('\*', '.*', $patternValue);
            if (1 === preg_match('#^'.$patternValue.'\z#u', (string) $value)) {
                return true;
            }
        }

        return false;
    }
}
