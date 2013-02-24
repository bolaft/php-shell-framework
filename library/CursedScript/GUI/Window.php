<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\GUI;

use CursedScript\GUI\Theme\StylizableInterface;
use CursedScript\Log\Log;

/**
 * Represents a graphical window
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Window implements StylizableInterface
{
	/**
	 * The ncurses window resource
	 * 
	 * @var resource
	 */
	protected $resource;

	/**
	 * @var array
	 */
	protected $borders;

	/**
	 * @var array
	 */
	protected $children = array();

	/**
	 * Constructor
	 * 
	 * @param int $rows
	 * @param int $cols
	 * @param int $y
	 * @param int $x
	 */
	public function __construct($rows, $cols, $y, $x)
	{
		new Log('NEW_WINDOW', func_get_args(), Log::$info_channel);

		$this->resource = ncurses_newwin($rows, $cols, $y, $x);
	}

	/**
	 * Draws the window's borders
	 * 
	 * @param  int $left
	 * @param  int $right
	 * @param  int $top
	 * @param  int $bottom
	 * @param  int $tl_corner
	 * @param  int $tr_corner
	 * @param  int $bl_corner
	 * @param  int $br_corner
	 * @return Window
	 */
	public function border($left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner)
	{
		call_user_func_array('ncurses_wborder', array_merge(array($this->resource), func_get_args()));

		$this->borders = func_get_args();

		return $this;
	}

	/**
	 * Writes a string at the given popsition
	 * 
	 * @param  string $string
	 * @param  int $y
	 * @param  int $x
	 * @return Window
	 */
	public function write($string, $y, $x)
	{
		ncurses_mvwaddstr($this->resource, $y, $x, $string);

		return $this;
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
	 * @return Windows
	 */
	public function setResource($resource)
	{
	    $this->resource = $resource;
	
	    return $this;
	}

	/**
	 * Get children
	 *
	 * @return array
	 */
	public function getChildren()
	{
	    return $this->children;
	}
	
	/**
	 * Set children
	 *
	 * @param  array $children
	 * @return Window
	 */
	public function setChildren(array $children)
	{
	    $this->children = $children;
	
	    return $this;
	}
	
	/**
	 * Add child
	 *
	 * @param  Window $child
	 * @return Window
	 */
	public function addChild(Window $child)
	{
	    $this->children[] = $child;
	
	    return $this;
	}
	
	/**
	 * Remove child
	 *
	 * @param  Window $child
	 * @return Window
	 */
	public function removeChild(Window $child)
	{
	    $this->children = array_diff($this->children, array($child));
	
	    return $this;
	}
}