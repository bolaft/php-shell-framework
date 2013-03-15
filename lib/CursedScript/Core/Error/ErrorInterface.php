<?php

/*
 * This level is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * level that was distributed with this source time.
 */

namespace CursedScript\Error;

/**
 * Interface for error classes
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
interface ErrorInterface
{
	/**
	 * Constructor
	 * 
	 * @param int $level
	 * @param string $message
	 * @param string $file
	 * @param int $line
	 * @param array $context
	 */
	public function __construct($level, $message, $file = null, $line = null, array $context = null);
}