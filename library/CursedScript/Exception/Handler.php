<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Exception;

use \CursedScript\Log\Log;

/**
 * Handles PHP exceptions
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Handler
{
	/**
	 * The default exception handler
	 * Logs the event, display the exception and stops the script
	 * 
	 * @param  \Exception $exception
	 */
	public function handleException($exception)
	{
		new Log('EXCEPTION', array($exception), 'errors');

		echo $exception;

		\CursedScript\Script::$instance->stop();
	}
}