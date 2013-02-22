<?php

/*
 * This file is part of the Scriptonic package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scriptonic\Tools;

/**
 * Performs string operations
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class String
{
    /**
     * Translates a camel case string into a string with underscores
     * 
     * @param  string $string
     * @return string $string
     */
    public static function fromCamelCase($string)
    {
        $string[0] = strtolower($string[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');

        return preg_replace_callback('/([A-Z])/', $func, $string);
    }

    /**
     * Translates a string with underscores into camel case
     * 
     * @param  string $string
     * @param  boolean $capitalise_first_char
     * @return string $string
     */
    public static function toCamelCase($string, $capitalise_first_char = false)
    {
        if ($capitalise_first_char) {
            $string[0] = strtoupper($string[0]);
        }

        $func = create_function('$c', 'return strtoupper($c[1]);');

        return preg_replace_callback('/_([a-z])/', $func, $string);
    }

    public static function removeNamespace($class)
    {
        $class = explode('\\', $class);

        return array_pop($class);
    }
}