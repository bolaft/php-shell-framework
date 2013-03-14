<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\GUI\Element;

/**
 * The Menu element
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Menu extends Element
{
	/**
	 * The ncurses window resource
	 * 
	 * @var resource
	 */
	protected $resource;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		// $this->resource = ncurses_new_menu();
	}

	/**
	 * Get resource
	 *
	 * @return resource
	 */
	public function getResource()
	{
	    return $this->resource;
	}
	
	/**
	 * Set resource
	 *
	 * @param  resource $resource
	 * @return Menu
	 */
	public function setResource($resource)
	{
	    $this->resource = $resource;
	
	    return $this;
	}
}