<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript;

/**
 * The Script class provides advanced console functionalities to classes who extend it
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
abstract class Script 
{
	/**
	 * @var CursedScript
	 * @static
	 */
	public static $instance = null;

	public function __construct()
	{
		self::$instance = $this;

		set_error_handler(array(new Debug\Error\Handler(), 'handleError'));
		set_exception_handler(array(new Debug\Exception\Handler(), 'handleException'));

		$this->run();
	}

	public function __destruct() 
	{
		restore_exception_handler();
		restore_error_handler();
	}

	public function run()
	{
		Debug\Log\Logger::log('info', array('Running CursedScript'));
	}

	public function stop()
	{
		Debug\Log\Logger::log('info', array('Stopping CursedScript'));

		$this->__destruct();
	}
}