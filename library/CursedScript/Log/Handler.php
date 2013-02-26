<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Log;

/**
 * The default log handler
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Handler extends \CursedScript\Handler
{
	/**
	 * @var string
	 */
	private $dir;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->handle = array($this, 'jsonHandle');
	}

	/**
	 * The default log handle
	 * Writes logs in json format in the log directory
	 * 
	 * @param  Logable log
	 */
	public function jsonHandle(Logable $log)
	{
		$channel = $log->getChannel();
		
		if (isset($this->dir)){
			$dir = $this->dir;

			$write = function($channel) use ($log, $dir)
			{
				if (is_null($channel)) return false;

		        $dir  = $dir . $channel;
		        $file = $dir . '/' . date('d_m_Y') . '.log.json';

		        if (!file_exists($file)){
		        	if ((is_dir($dir) or @mkdir($dir)) and @fopen($file, 'x+')){
		        		$contents = array('[' . PHP_EOL);
		        	} else {
		        		if ($channel !== Log::$error_channel && $channel !== Log::$exception_channel){
		        			throw new \Exception('Invalid log directory', 1);
		        		}

		        		return false;
		        	}
		        } else {
		        	$contents = file($file);
		        	array_pop($contents);
		        	$contents[sizeof($contents) - 1] = str_replace(PHP_EOL, ',' . PHP_EOL, $contents[sizeof($contents) - 1]);
		        }

		        $log_output = ($log instanceof JsonSerializable) ? $log->toJson() : json_encode((array) $log);

		        $contents[] = "\t" . $log_output . PHP_EOL;
		        $contents[] = ']';

		        @file_put_contents($file, implode($contents));
			};

	        $write(Log::$main_channel);

	        if (!is_null($channel) && $channel !== Log::$main_channel){
	        	$write($channel);
	        }
		}
	}

	/**
	 * Sets the log directory
	 * 
	 * @param string $dir
	 * @return Handler
	 */
	public function setDir($dir)
	{
		if (substr($dir, -1) !== '/') $dir .= '/';

		$this->dir = $dir;

		return $this;
	}

	/**
	 * Get dir
	 * 
	 * @return string
	 */
	public function getDir()
	{
		return $this->dir;
	}
}