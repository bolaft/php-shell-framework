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

use \CursedScript\Log;

/**
 * The Script class provides advanced console functionalities to classes who extend it
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
abstract class Script
{
	/**
	 * @var Script
	 * @static
	 */
	public static $instance;

	/**
	 * @var Log\Logger
	 * @static
	 */
	public $logger;

	/**
	 * Get instance
	 *
	 * @return Script
	 */
	public static function getInstance()
	{
	    return Script::$instance;
	}

	/**
	 * Constructor
	 * Sets exception and error handlers, then starts, runs and stops the script
	 */
	final public function __construct()
	{
		self::$instance = $this;

		$this->logger  = new Log\Logger();

		set_error_handler(array(new Error\Handler(), 'handleError'));
		set_exception_handler(array(new Exception\Handler(), 'handleException'));

		@$this->init();
		@$this->start();
		@$this->run();
		@$this->stop();
	}

	/**
	 * Destructor
	 * Restores exception and error handlers
	 */
	final public function __destruct() 
	{
		restore_exception_handler();
		restore_error_handler();
	}

	/**
	 * Starts the script
	 */
	final public function start()
	{
		new Log\Log('INFO', array('Starting CursedScript'));
	}

	/**
	 * Stops the script
	 */
	final public function stop()
	{
		new Log\Log('INFO', array('Stopping CursedScript'));

		$this->__destruct();
	}

	/**
	 * Custom script initialization
	 */
	public function init()
	{

	}

	/**
	 * Custom script execution
	 */
	public function run()
	{

	}

	/**
	 * Get logger
	 *
	 * @return Log\Logger
	 */
	public function getLogger()
	{
	    return $this->logger;
	}
	
	/**
	 * Set logger
	 *
	 * @param  Log\Logger $logger
	 * @return Script
	 */
	public function setLogger($logger)
	{
	    $this->logger = $logger;
	
	    return $this;
	}
}