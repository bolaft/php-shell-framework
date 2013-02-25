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
use \CursedScript\Log\Logger;

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
	 * @var Log\Logger
	 */
	private $logger;

	/**
	 * @var resource
	 */
	private $ncurses;

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

		$this->logger  = new Logger();

		set_error_handler(array(new Error\Handler(), 'handleError'));
		set_exception_handler(array(new Exception\Handler(), 'handleException'));

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

		ncurses_end();
	}

	/**
	 * Starts the script
	 */
	final public function start()
	{
		if (!isset($this->ini)) $this->ini = dirname(__DIR__) . '/settings.ini';

		if (file_exists($this->ini)){
			$config = parse_ini_file($this->ini, true);
		}

		if(isset($config['channels'])) Log::setChannels($config['channels']);
		if(isset($config['logger']['dir'])) $this->logger->setDir($config['logger']['dir']);

		new Log('SCRIPT_STARTS', array($config), Log::$info_channel);

		$this->ncurses = ncurses_init();
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
	 * Get logger
	 *
	 * @return Log\Logger
	 */
	final public function getLogger()
	{
	    return $this->logger;
	}
	
	/**
	 * Set logger
	 *
	 * @param  Log\Logger $logger
	 * @return Script
	 */
	final public function setLogger(Log\Logger $logger)
	{
	    $this->logger = $logger;
	
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
}