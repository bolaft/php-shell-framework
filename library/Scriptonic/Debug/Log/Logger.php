<?php

/*
 * This file is part of the Scriptonic package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scriptonic\Debug\Log;

use \Scriptonic\Tools\String;

/**
 * Define logging parameters
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Logger
{
	/**
	 * @var string
	 * @static
	 */
	public static $dir;

	public static function setDir($dir)
	{
		if (substr($dir, -1) !== '/') $dir .= '/';

		self::$dir = $dir;
	}
}