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
abstract class Logger
{
	/**
	 * @var string
	 */
	private static $dir;

	/**
	 * @var callable
	 */
	private static $handle = '\CursedScript\Debug\Log\Logger::handle';

	public static function log()
	{
		call_user_func_array(Logger::$handle, func_get_args());

	}

	public static function handle($level, $data, $channel = null)
	{
		$log = new Log();
		$log->setDate(date('d-m-Y'))
		    ->setTime(date('H:i:s'))
		    ->setLevel($level)
		    ->setData($data);

		if (isset(Logger::$dir)){
			$write = function($channel) use ($log){
		        $file = Logger::$dir . $channel . '_' . date('d_m_Y') . '.json';

		        if (!file_exists($file)){
		        	fopen($file, 'x+');
		        	$contents = array('[' . PHP_EOL);
		        } else {
		        	$contents = file($file);
		        	array_pop($contents);
		        	$contents[sizeof($contents) - 1] = str_replace(PHP_EOL, ',' . PHP_EOL, $contents[sizeof($contents) - 1]);
		        }

		        $contents[] = "\t" . $log->serialize() . PHP_EOL;
		        $contents[] = ']';

		        file_put_contents($file, implode($contents));
			};

	        $write('all');

	        if (!is_null($channel) && $channel !== 'all'){
	        	$write($channel);
	        }
		}
	}

	public static function setDir($dir)
	{
		if (substr($dir, -1) !== '/') $dir .= '/';

		Logger::$dir = $dir;
	}

	public static function setHandle($handle)
	{
		Logger::$handle = $handle;
	}
}