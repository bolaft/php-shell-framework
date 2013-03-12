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
use \CursedScript\Script;
use \CursedScript\Shell\Input\Keyboard;

/**
 * Handles PHP exceptions
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
		$this->handle = array($this, 'screenHandle');
	}

	/**
	 * The default exception handler
	 * Logs the event, display the exception in a screen a stops the script
	 * 
	 * @param  \Exception $exception
	 */
	public function screenHandle(\Exception $exception)
	{
		new Log('EXCEPTION', func_get_args(), Log::$exception_channel);

		$screen = new Screen($exception);
		
		Script::$instance->select($screen)
		                 ->refresh();

		Keyboard::input();

		Script::$instance->stop();
	}

	/**
	 * The classic exception handler
	 * Logs the event, display the exception and stops the script
	 * 
	 * @param  \Exception $exception
	 */
	public function echoHandle(\Exception $exception)
	{
		new Log('EXCEPTION', func_get_args(), Log::$exception_channel);

		var_dump($exception);
		
		\CursedScript\Script::$instance->stop();
	}
}