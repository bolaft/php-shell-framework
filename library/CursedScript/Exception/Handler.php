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
class Handler extends \CursedScript\Handler
{
	/**
	 * The default exception handler
	 * Logs the event, display the exception and stops the script
	 * 
	 * @param  \Exception $exception
	 */
	public function handle(\Exception $exception)
	{
		new Log('EXCEPTION', func_get_args(), Log::$exception_channel);

		var_dump($exception);
		
		\CursedScript\Script::$instance->stop();
	}
}