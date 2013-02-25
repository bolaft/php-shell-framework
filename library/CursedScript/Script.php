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

use \CursedScript\Log\Log;
use \CursedScript\Log\Handler;

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
	 * @var string
	 */
	private $ini;

	/**
	 * @var resource
	 */
	private $ncurses;

	/**
	 * @var Log\Handler
	 */
	private $log_handler;

	/**
	 * @var Error\Handler
	 */
	private $error_handler;

	/**
	 * @var Exception\Handler
	 */
	private $exception_handler;

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

		$this->log_handler       = new Handler();
		$this->error_handler     = new Handler();
		$this->exception_handler = new Handler();

		$this->init();
		$this->start();
		$this->run();
		$this->stop();
	}

	/**
	 * Destructor
	 * Restores exception and error handlers
	 */
	final public function __destruct() 
	{
		restore_exception_handler();
		restore_error_handler();

		ncurses_echo();
		ncurses_end();
	}

	/**
	 * Starts the script
	 */
	final public function start()
	{
		// Handlers
		set_error_handler($this->error_handler->getHandle());
		set_exception_handler($this->exception_handler->getHandle());

		// INI settings
		if (!isset($this->ini)) $this->ini = dirname(__DIR__) . '/settings.ini';

		if (file_exists($this->ini)){
			$config = parse_ini_file($this->ini, true);
		}

		if(isset($config['channels'])) Log::setChannels($config['channels']);
		if(isset($config['logger']['dir'])) $this->log_handler->setDir($config['logger']['dir']);

		new Log('SCRIPT_STARTS', array($config), Log::$info_channel);

		// Ncurses initialization
		$this->ncurses = ncurses_init();
		ncurses_noecho();
	}

	/**
	 * Stops the script
	 */
	final public function stop()
	{
		new Log('SCRIPT_STOPPED', array(), Log::$info_channel);

		$this->__destruct();
	}

	/**
	 * Custom script initialization
	 */
	abstract public function init();

	/**
	 * Custom script execution
	 */
	abstract public function run();

	/**
	 * Get ini
	 *
	 * @return string
	 */
	final public function getIni()
	{
	    return $this->ini;
	}
	
	/**
	 * Set ini
	 *
	 * @param  string $ini
	 * @return Script
	 */
	final public function setIni($ini)
	{
	    $this->ini = $ini;
	
	    return $this;
	}

	/**
	 * Get ncurses
	 *
	 * @return resource
	 */
	final public function getNcurses()
	{
	    return $this->ncurses;
	}
	
	/**
	 * Set ncurses
	 *
	 * @param  resource $ncurses
	 * @return Script
	 */
	final public function setNcurses($ncurses)
	{
	    $this->ncurses = $ncurses;
	
	    return $this;
	}

	/**
	 * Get log_handler
	 *
	 * @return Log\Handler
	 */
	final public function getLogHandler()
	{
	    return $this->log_handler;
	}
	
	/**
	 * Set log_handler
	 *
	 * @param  Log\Handler $log_handler
	 * @return Script
	 */
	final public function setLogHandler(Log\Handler $log_handler)
	{
	    $this->log_handler = $log_handler;
	
	    return $this;
	}

	/**
	 * Get error_handler
	 *
	 * @return Error\Handler
	 */
	public function getErrorHandler()
	{
	    return $this->error_handler;
	}
	
	/**
	 * Set error_handler
	 *
	 * @param  Error\Handler $error_handler
	 * @return Script
	 */
	public function setErrorHandler($error_handler)
	{
	    $this->error_handler = $error_handler;
	
	    return $this;
	}

	/**
	 * Get exception_handler
	 *
	 * @return Exception\Handler
	 */
	public function getExceptionHandler()
	{
	    return $this->exception_handler;
	}
	
	/**
	 * Set exception_handler
	 *
	 * @param  Exception\Handler $exception_handler
	 * @return Script
	 */
	public function setExceptionHandler($exception_handler)
	{
	    $this->exception_handler = $exception_handler;
	
	    return $this;
	}
}