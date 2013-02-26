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

use CursedScript\GUI\Theme\Visual;
use CursedScript\GUI\Element\Element;
use CursedScript\Log\Log;

/**
 * Represents a graphical window
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Window extends Visual
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
	protected $elements = array();

	/**
	 * @var int
	 */
	protected $width;

	/**
	 * @var int
	 */
	protected $height;

	/**
	 * @var int
	 */
	protected $position_y;

	/**
	 * @var int
	 */
	protected $position_x;

	/**
	 * @var boolean
	 */
	protected $border_top = true;

	/**
	 * @var boolean
	 */
	protected $border_bottom = true;

	/**
	 * @var boolean
	 */
	protected $border_left = true;

	/**
	 * @var boolean
	 */
	protected $border_right = true;

	/**
	 * @var boolean
	 */
	protected $border_top_left = true;

	/**
	 * @var boolean
	 */
	protected $border_top_right = true;

	/**
	 * @var boolean
	 */
	protected $border_bottom_left = true;

	/**
	 * @var boolean
	 */
	protected $border_bottom_right = true;

	/**
	 * @var array
	 */
	protected $screen;

	/**
	 * Constructor
	 * 
	 * @param int $width
	 * @param int $height
	 * @param int $y
	 * @param int $x
	 */
	public function __construct($width, $height, $y, $x)
	{
		$this->width  = $width;
		$this->height = $height;

		$this->position_y = $y;
		$this->position_x = $x;

		new Log('NEW_WINDOW', func_get_args(), Log::$info_channel);

		$this->resource = ncurses_newwin($width, $height, $y, $x);
	}

	/**
	 * /**
	 * Borders the window
	 * 	
	 * @param  boolean $top
	 * @param  boolean $bottom
	 * @param  boolean $left
	 * @param  boolean $right
	 * @param  boolean $top_left
	 * @param  boolean $top_right
	 * @param  boolean $bottom_left
	 * @param  boolean $bottom_right
	 * @return Window
	 */
	public function border($top = null, $bottom = null, $left = null, $right = null, $top_left = null, $top_right = null, $bottom_left = null, $bottom_right = null)
	{
		if (!is_null($top))          $this->setTop($top);
		if (!is_null($bottom))       $this->setBottom($bottom);
		if (!is_null($left))         $this->setLeft($left);
		if (!is_null($right))        $this->setRight($right);
		if (!is_null($top_left))     $this->setTopLeft($top_left);
		if (!is_null($top_right))    $this->setTopRight($top_right);
		if (!is_null($bottom_left))  $this->setBottomLeft($bottom_left);
		if (!is_null($bottom_right)) $this->setBottomRight($bottom_right);

		if ($this instanceof Screen){
			call_user_func_array('ncurses_border', $this->getBorders());
		} else {
			call_user_func_array('ncurses_wborder', array_merge(array($this->resource), $this->getBorders()));
		}
		
		return $this;
	}

	/**
	 * Moves the window
	 * 
	 * @param  int $y
	 * @param  int $x
	 * @return Window
	 */
	public function move($y = null, $x = null)
	{
		if (!is_null($y)) $this->setPositionY($y);
		if (!is_null($x)) $this->setPositionX($x);

		if ($this instanceof Screen){
			call_user_func_array('ncurses_move', array($this->getPositionY(), $this->getPositionX()));
		} else {
			call_user_func_array('ncurses_wmove', array_merge(array($this->resource), array($this->getPositionY(), $this->getPositionX())));
		}
		
		return $this;
	}

	/**
	 * Resizes the window
	 *
	 * @param int $width
	 * @param int $height
	 * @return Window
	 */
	public function resize($width = null, $height = null)
	{
		if (!is_null($width))  $this->setWidth($width);
		if (!is_null($height)) $this->setHeight($height);

		if ($this instanceof Screen){
			throw new \CursedScript\Exception\Exception('Cannot resize a screen object', 1);
		} else {
			call_user_func_array('ncurses_wmove', array_merge(array($this->resource), array($this->getPositionY(), $this->getPositionX())));
		}
		
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
		if ($this instanceof Screen){
			ncurses_mvaddstr($this->resource, $y, $x, $string);
		} else {
			ncurses_mvwaddstr($this->resource, $y, $x, $string);
		}

		return $this;
	}


	/**
	 * Add a visual to the window
	 * 
	 * @param Visual $visual
	 * @return Window
	 */
	public function add(Visual $visual)
	{
		if ($visual instanceof Element){
			$this->addElement($visual);
			$visual->setWindow($this);
		}
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
	 * Returns all borders as an array
	 * 
	 * @return array
	 */
	final public function getBorders()
	{
		$borders = array();

		$borders[] = $this->border_top          === true ? 0 : 1;
		$borders[] = $this->border_bottom       === true ? 0 : 1;
		$borders[] = $this->border_left         === true ? 0 : 1;
		$borders[] = $this->border_right        === true ? 0 : 1;
		$borders[] = $this->border_top_left     === true ? 0 : 1;
		$borders[] = $this->border_top_right    === true ? 0 : 1;
		$borders[] = $this->border_bottom_left  === true ? 0 : 1;
		$borders[] = $this->border_bottom_right === true ? 0 : 1;

		return $borders;
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
	 * Get screen
	 *
	 * @return int
	 */
	public function getScreen()
	{
	    return $this->screen;
	}
	
	/**
	 * Set screen
	 *
	 * @param  int $screen
	 * @return int
	 */
	public function setScreen(Screen $screen)
	{
	    $this->screen = $screen;
	    
	    return $this;
	}

	/**
	 * Get elements
	 *
	 * @return array
	 */
	public function getElements()
	{
	    return $this->elements;
	}
	
	/**
	 * Set elements
	 *
	 * @param  array $elements
	 * @return Element
	 */
	public function setElements(array $elements)
	{
	    $this->elements = $elements;
	
	    return $this;
	}
	
	/**
	 * Add element
	 *
	 * @param  Element $element
	 * @return Element
	 */
	public function addElement(Element $element)
	{
	    $this->elements[] = $element;
	
	    return $this;
	}
	
	/**
	 * Remove element
	 *
	 * @param  Element $element
	 * @return Element
	 */
	public function removeElement(Element $element)
	{
	    $this->elements = array_diff($this->elements, array($element));
	
	    return $this;
	}

	/**
	 * Get width
	 *
	 * @return int
	 */
	public function getWidth()
	{
	    return $this->width;
	}
	
	/**
	 * Set width
	 *
	 * @param  int $width
	 * @return Window
	 */
	public function setWidth($width)
	{
	    $this->width = $width;
	
	    return $this;
	}

	/**
	 * Get height
	 *
	 * @return int
	 */
	public function getHeight()
	{
	    return $this->height;
	}
	
	/**
	 * Set height
	 *
	 * @param  int $height
	 * @return Window
	 */
	public function setHeight($height)
	{
	    $this->height = $height;
	
	    return $this;
	}

	/**
	 * Get position_y
	 *
	 * @return int
	 */
	public function getPositionY()
	{
	    return $this->position_y;
	}
	
	/**
	 * Set position_y
	 *
	 * @param  int $position_y
	 * @return Window
	 */
	public function setPositionY($position_y)
	{
	    $this->position_y = $position_y;
	
	    return $this;
	}

	/**
	 * Get position_x
	 *
	 * @return int
	 */
	public function getPositionX()
	{
	    return $this->position_x;
	}
	
	/**
	 * Set position_x
	 *
	 * @param  int $position_x
	 * @return Window
	 */
	public function setPositionX($position_x)
	{
	    $this->position_x = $position_x;
	
	    return $this;
	}

	/**
	 * Get border_top
	 *
	 * @return boolean
	 */
	public function getBorderTop()
	{
	    return $this->border_top;
	}
	
	/**
	 * Set border_top
	 *
	 * @param  boolean $border_top
	 * @return Window
	 */
	public function setBorderTop($border_top)
	{
	    $this->border_top = $border_top;
	
	    return $this;
	}

	/**
	 * Get border_bottom
	 *
	 * @return boolean
	 */
	public function getBorderBottom()
	{
	    return $this->border_bottom;
	}
	
	/**
	 * Set border_bottom
	 *
	 * @param  boolean $border_bottom
	 * @return Window
	 */
	public function setBorderBottom($border_bottom)
	{
	    $this->border_bottom = $border_bottom;
	
	    return $this;
	}

	/**
	 * Get border_left
	 *
	 * @return boolean
	 */
	public function getBorderLeft()
	{
	    return $this->border_left;
	}
	
	/**
	 * Set border_left
	 *
	 * @param  boolean $border_left
	 * @return Window
	 */
	public function setBorderLeft($border_left)
	{
	    $this->border_left = $border_left;
	
	    return $this;
	}

	/**
	 * Get border_right
	 *
	 * @return boolean
	 */
	public function getBorderRight()
	{
	    return $this->border_right;
	}
	
	/**
	 * Set border_right
	 *
	 * @param  boolean $border_right
	 * @return Window
	 */
	public function setBorderRight($border_right)
	{
	    $this->border_right = $border_right;
	
	    return $this;
	}

	/**
	 * Get border_top_left
	 *
	 * @return boolean
	 */
	public function getBorderTopLeft()
	{
	    return $this->border_top_left;
	}
	
	/**
	 * Set border_top_left
	 *
	 * @param  boolean $border_top_left
	 * @return Window
	 */
	public function setBorderTopLeft($border_top_left)
	{
	    $this->border_top_left = $border_top_left;
	
	    return $this;
	}

	/**
	 * Get border_top_right
	 *
	 * @return boolean
	 */
	public function getBorderTopRight()
	{
	    return $this->border_top_right;
	}
	
	/**
	 * Set border_top_right
	 *
	 * @param  boolean $border_top_right
	 * @return Window
	 */
	public function setBorderTopRight($border_top_right)
	{
	    $this->border_top_right = $border_top_right;
	
	    return $this;
	}

	/**
	 * Get border_bottom_left
	 *
	 * @return boolean
	 */
	public function getBorderBottomLeft()
	{
	    return $this->border_bottom_left;
	}
	
	/**
	 * Set border_bottom_left
	 *
	 * @param  boolean $border_bottom_left
	 * @return Window
	 */
	public function setBorderBottomLeft($border_bottom_left)
	{
	    $this->border_bottom_left = $border_bottom_left;
	
	    return $this;
	}

	/**
	 * Get border_bottom_right
	 *
	 * @return boolean
	 */
	public function getBorderBottomRight()
	{
	    return $this->border_bottom_right;
	}
	
	/**
	 * Set border_bottom_right
	 *
	 * @param  boolean $border_bottom_right
	 * @return Window
	 */
	public function setBorderBottomRight($border_bottom_right)
	{
	    $this->border_bottom_right = $border_bottom_right;
	
	    return $this;
	}
}