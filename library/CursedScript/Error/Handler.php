<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Error;

use \CursedScript\Log\Log;
use \CursedScript\Script;

/**
 * Handles PHP errors
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Handler extends \CursedScript\Handler
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->handle = array($this, 'echoHandle');
	}

	/**
	 * The default error handler
	 * Logs the event, display the error and stops the script
	 * 
	 * @param  int $level
	 * @param  string $message
	 * @param  string $file
	 * @param  int $line
	 * @param  array $context
	 */
	public function echoHandle($level, $message, $file = null, $line = null, array $context = null)
	{
		new Log('ERROR', func_get_args(), Log::$error_channel);

		$error = new Error($level, $message, $file, $line, $context);

		var_dump($error);

		Script::$instance->stop();
	}
}