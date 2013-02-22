<?php

/*
 * This file is part of the Scriptonic package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scriptonic;

/**
 * The Scriptonic class provides simple Shell functionalities to classes who extend it
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
abstract class Scriptonic 
{
	use Debug\Log\Loggable;

	/**
	 * @var Scriptonic
	 * @static
	 */
	public static $instance = null;

	public function __construct()
	{
		self::$instance = $this;

		set_error_handler(array(new Debug\Error\ErrorHandler(), 'handleError'));
		set_exception_handler(array(new Debug\Exception\ExceptionHandler(), 'handleException'));

		$this->run();
	}

	public function __destruct() 
	{
		restore_exception_handler();
		restore_error_handler();
	}

	public function run()
	{
		$this->log('info', array('Running Scriptonic'));
	}

	public function stop()
	{
		$this->log('info', array('Stopping Scriptonic'));

		$this->__destruct();
	}
}