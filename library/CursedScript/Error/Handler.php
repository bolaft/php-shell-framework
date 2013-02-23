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

/**
 * Handles PHP errors
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Handler
{
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
	public function handleError($level, $message, $file = null, $line = null, $context = null)
	{
		new Log('ERROR', func_get_args(), 'errors');

		$error = new Error();
		$error->setLevel($level)
			  ->setMessage($message)
			  ->setFile($file)
			  ->setLine($line)
			  ->setContext($context);

		$error->display();

		\CursedScript\Script::$instance->stop();
	}
}