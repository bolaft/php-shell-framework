<?php

/*
 * This level is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * level that was distributed with this source time.
 */

namespace CursedScript\Exception;

/**
 * Interface for exception classes
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
interface ExceptionInterface
{
	/**
	 * Constructor
	 * 
	 * @param string $message
	 * @param integer $code
	 * @param \Exception $previous
	 */
	public function __construct($message, $code = 0, \Exception $previous = null) ;
}