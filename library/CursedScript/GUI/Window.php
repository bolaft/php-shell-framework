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

use CursedScript\GUI\Theme\Stylizable;
use CursedScript\Log\Log;

/**
 * Represents a graphical window
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Window extends Stylizable
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
	protected $parent;

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
	public function __construct($rows, $cols, $y, $x, $border = true)
	{
		new Log('NEW_WINDOW', func_get_args(), Log::$info_channel);

		$this->resource = ncurses_newwin($rows, $cols, $y, $x);

		if ($border === true) $this->border();
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
	public function border($left = 0, $right = 0, $top = 0, $bottom = 0, $tl_corner = 0, $tr_corner = 0, $bl_corner = 0, $br_corner = 0)
	{
		$this->borders = array($left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner);

		call_user_func_array('ncurses_wborder', array_merge(array($this->resource), $this->borders));

		return $this;
	}

	/**
	 * Writes a string at the given position
	 * 
	 * @param  string $string
	 * @param  int $y
	 * @param  int $x
	 * @return Window
	 */
	public function write($string, $y = 1, $x = 1)
	{
		ncurses_mvwaddstr($this->resource, $y, $x, $string);

		return $this;
	}

	/**
	 * Get style class for stylization
	 */
	final public function getStyleClass()
	{
		if ($this instanceof Screen){
			return 'screen';
		} else {
			return 'window';
		}
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
	 * Get parent
	 *
	 * @return type
	 */
	public function getParent()
	{
	    return $this->parent;
	}
	
	/**
	 * Set parent
	 *
	 * @param  type $parent
	 * @return type
	 */
	public function setParent($parent)
	{
	    $this->parent = $parent;
	    
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
		$child->setParent($this);
	
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