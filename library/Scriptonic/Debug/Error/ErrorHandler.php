<?php

/*
 * This file is part of the Scriptonic package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scriptonic\Debug\Error;

use \Scriptonic\Debug\Log;

/**
 * Handles PHP errors
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class ErrorHandler
{
	use Log\Loggable;

	public function handleError($level, $message, $file = null, $line = null, $context = null)
	{
		$this->log('ERROR', func_get_args(), 'errors');

		$error = (new Error())
			->setLevel($level)
			->setMessage($message)
			->setFile($file)
			->setLine($line)
			->setContext($context);

		$error->display();

		\Scriptonic\Scriptonic::$instance->stop();
	}
}