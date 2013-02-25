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
 * The parent of all handler classes
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
abstract class Handler
{
	/**
	 * @var callable
	 */
	private $handle;

	public function __construct()
	{
		$this->handle = array($this, 'handle');
	}

	/**
	 * Get handle
	 *
	 * @return callable
	 */
	public function getHandle()
	{
	    return $this->handle;
	}
	
	/**
	 * Set handle
	 *
	 * @param  callable $handle
	 * @return Handler
	 */
	public function setHandle($handle)
	{
	    $this->handle = $handle;
	
	    return $this;
	}
}