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

use CursedScript\Tool\FileSystem\Explorer;
use CursedScript\Tool\Json;

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
	 * Writes logs in json format in the log directory
	 * 
	 * @param  Logable log
	 */
	public function jsonHandle(Logable $log)
	{
		$channel = $log->getChannel();
		
		if (!isset($this->dir)){
			return false;
		} else {
			$dir = $this->dir;
		}

		$write = function($channel) use ($log, $dir)
		{
			if (is_null($channel)) return false;

			$file = $dir . $channel . '/' . date('d_m_Y') . '.log.json';

        	if (($contents = Explorer::exploreFile($file, true)) !== false){
        		if (empty($contents)){
        			$contents = array('[' . PHP_EOL);
        		} else {
		        	array_pop($contents);
		        	$contents[sizeof($contents) - 1] = str_replace(PHP_EOL, ',' . PHP_EOL, $contents[sizeof($contents) - 1]);
        		}
        	} else {
        		return false;
        	}

	        $log_output = ($log instanceof Json\Serializable) ? $log->toJson() : str_replace('\u0000*\u0000', '', json_encode((array) $log, JSON_UNESCAPED_UNICODE));

	        $contents[] = "\t" . $log_output . PHP_EOL;
	        $contents[] = ']';

	        @file_put_contents($file, implode($contents));
		};

        $write(Log::$main_channel);

        if ($channel !== Log::$main_channel){
        	$write($channel);
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