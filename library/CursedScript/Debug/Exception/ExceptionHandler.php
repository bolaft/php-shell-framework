<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Debug\Exception;

use \CursedScript\Debug\Log;

/**
 * Handles PHP exceptions
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class ExceptionHandler
{
	public function handleException($e)
	{
		Log\Logger::log('EXCEPTION', array($e), 'errors');

		$exception = new Exception();
		$exception->setMessage($e->getMessage())
				  ->setCode($e->getCode())
				  ->setFile($e->getFile())
				  ->setLine($e->getLine())
				  ->setTrace($e->getTrace());

		$exception->display();

		\CursedScript\Script::$instance->stop();
	}
}