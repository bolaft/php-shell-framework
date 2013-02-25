<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Error;

/**
 * Represents a PHP error
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Error implements ErrorInterface
{
	public static $levels = array(
		2    => 'E_WARNING',
		8    => 'E_NOTICE',
		256  => 'E_USER_ERROR',
		512  => 'E_USER_WARNING',
		1024 => 'E_USER_NOTICE',
		4096 => 'E_RECOVERABLE_ERROR',
		8191 => 'E_ALL',
	);

	/**
	 * @var int
	 */
	protected $level;

	/**
	 * @var string
	 */
	protected $message;

	/**
	 * @var string
	 */
	protected $file;

	/**
	 * @var int
	 */
	protected $line;

	/**
	 * @var array
	 */
	protected $context;

	/**
	 * @{inheritDoc}
	 */
	public function __construct($level, $message, $file = null, $line = null, array $context = null)
	{
		$this->setLevel($level)
			 ->setMessage($message)
			 ->setFile($file)
			 ->setLine($line)
			 ->setContext($context);
	}

	/**
	 * Get level
	 *
	 * @return int
	 */
	public function getLevel()
	{
	    return $this->level;
	}
	
	/**
	 * Set level
	 *
	 * @param  int $level
	 * @return Error
	 */
	public function setLevel($level)
	{
	    $this->level = $level;
	
	    return $this;
	}
	
	/**
	 * Get message
	 *
	 * @return string
	 */
	public function getMessage()
	{
	    return $this->message;
	}
	
	/**
	 * Set message
	 *
	 * @param  string $message
	 * @return Error
	 */
	public function setMessage($message)
	{
	    $this->message = $message;
	
	    return $this;
	}

	/**
	 * Get file
	 *
	 * @return string
	 */
	public function getFile()
	{
	    return $this->file;
	}
	
	/**
	 * Set file
	 *
	 * @param  string $file
	 * @return Error
	 */
	public function setFile($file)
	{
	    $this->file = $file;
	
	    return $this;
	}

	/**
	 * Get line
	 *
	 * @return int
	 */
	public function getLine()
	{
	    return $this->line;
	}
	
	/**
	 * Set line
	 *
	 * @param  int $line
	 * @return Error
	 */
	public function setLine($line)
	{
	    $this->line = $line;
	
	    return $this;
	}

	/**
	 * Get context
	 *
	 * @return array
	 */
	public function getContext()
	{
	    return $this->context;
	}
	
	/**
	 * Set context
	 *
	 * @param  array $context
	 * @return Error
	 */
	public function setContext(array $context)
	{
	    $this->context = $context;
	
	    return $this;
	}
}