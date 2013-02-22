<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Debug\Error;

use \CursedScript\Debug\Log;

/**
 * Handles PHP errors
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Handler
{
	public function handleError($level, $message, $file = null, $line = null, $context = null)
	{
		Log\Logger::log('ERROR', func_get_args(), 'errors');

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