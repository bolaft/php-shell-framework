<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Debug\Log;

/**
 * The default logger
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Logger implements LoggerInterface
{
	/**
	 * @var string
	 * @static
	 */
	public static $dir;

	public static function setDir($dir)
	{
		if (substr($dir, -1) !== '/') $dir .= '/';

		Logger::$dir = $dir;
	}

	public static function log($level, $data, $channel = null)
	{
		if (isset(Logger::$dir)){
			$write = function($channel) use ($level, $data){
				$output = json_encode(array(date('H:i:s'), $level, $data));

		        $file = Logger::$dir . $channel . '_' . date('d_m_Y') . '.json';

		        if (!file_exists($file)) fopen($file, 'x+');

		        file_put_contents($file, $output . PHP_EOL, FILE_APPEND);
			};

	        $write('all');

	        if (!is_null($channel) && $channel !== 'all'){
	        	$write($channel);
	        }
		}
	}
}