<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('ROOT_PATH', dirname(__DIR__) . '/'); 

function __autoload($class)
{
	require_once ROOT_PATH . 'lib/' . str_replace('\\', '/', $class) . '.php';
}