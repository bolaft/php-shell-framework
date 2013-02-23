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

/**
 * Represents a PHP exception
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Exception extends \Exception
{
	/**
	 * Sets the previous 
	 * 
	 * @param \Exception $exception
	 */
	public function __construct($message, $code = 0, Exception $previous = null) 
	{
    	parent::__construct($message, $code, $previous);
	}

	/**
	 * Displays the exception
	 */
	public function display()
	{
		echo $this;
	}
}