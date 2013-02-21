<?php

/*
 * This file is part of the Scriptonic package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scriptonic\Debug\Exception;

use \Scriptonic\Debug\Log;

/**
 * Handles PHP exceptions
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class ExceptionHandler
{
	use Log\Loggable;

	public function handleException($e)
	{
		$this->log('EXCEPTION', array($e), 'errors');

		$exception = (new Exception())
			->setMessage($e->getMessage())
			->setCode($e->getCode())
			->setFile($e->getFile())
			->setLine($e->getLine())
			->setTrace($e->getTrace());

		$exception->display();

		\Scriptonic\Scriptonic::$instance->stop();
	}
}