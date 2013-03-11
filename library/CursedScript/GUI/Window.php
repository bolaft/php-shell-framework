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
	 * The ncurses panel resource
	 * 
	 * @var resource
	 */
	protected $panel;

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
	protected $row;

	/**
	 * @var int
	 */
	protected $col;

	/**
	 * @var mixed
	 */
	protected $border_top = 0;

	/**
	 * @var mixed
	 */
	protected $border_bottom = 0;

	/**
	 * @var mixed
	 */
	protected $border_left = 0;

	/**
	 * @var mixed
	 */
	protected $border_right = 0;

	/**
	 * @var mixed
	 */
	protected $border_top_left = 0;

	/**
	 * @var mixed
	 */
	protected $border_top_right = 0;

	/**
	 * @var mixed
	 */
	protected $border_bottom_left = 0;

	/**
	 * @var mixed
	 */
	protected $border_bottom_right = 0;

	/**
	 * @var array
	 */
	protected $screen;

	/**
	 * Constructor
	 * 
	 * @param int $width
	 * @param int $height
	 * @param int $row
	 * @param int $col
	 */
	public function __construct($width, $height, $row, $col)
	{
		$this->row = $row;
		$this->col = $col;

		new Log('NEW_WINDOW', func_get_args(), Log::$info_channel);

		$this->resource = ncurses_newwin($width, $height, $row, $col);
		$this->panel    = ncurses_new_panel($this->resource);

		ncurses_getmaxyx($this->resource, $this->width, $this->height);
	}

	/**
	 * Destructor
	 */
	public function __destruct()
	{
		// Makes sure the panel resource is unreferenced before its window
		// (required to prevent a "double-linked list corrupted" error)
		
		$this->panel    = null;
		$this->resource = null;
	}

	/**
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
	 * Clears the window
	 * 
	 * @return Window
	 */
	public function clear()
	{
		ncurses_wclear($this->resource);

		return $this;
	}

	/**
	 * Moves the window
	 * 
	 * @param  int $row
	 * @param  int $col
	 * @return Window
	 */
	public function move($row = null, $col = null)
	{
		if (!is_null($row)) $this->setRow($row);
		if (!is_null($col)) $this->setCol($col);
			
		call_user_func_array('ncurses_wmove', array_merge(array($this->resource), array($this->getRow(), $this->getCol())));
		
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

		call_user_func_array('ncurses_wmove', array_merge(array($this->resource), array($this->getRow(), $this->getCol())));
		
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

		return $this;
	}
	/**
	 * Get style class for stylization
	 */
	final public function getStyleClass()
	{
		return 'window';
	}

	/**
	 * Returns all borders as an array
	 * 
	 * @return array
	 */
	final public function getBorders()
	{
		$borders = array();

		$borders[] = $this->border_top;
		$borders[] = $this->border_bottom;
		$borders[] = $this->border_left;
		$borders[] = $this->border_right;
		$borders[] = $this->border_top_left;
		$borders[] = $this->border_top_right;
		$borders[] = $this->border_bottom_left;
		$borders[] = $this->border_bottom_right;

		// Turns string border values into ASCII
		array_walk($borders, function(&$value){
			if (is_string($value)) $value = ord($value);
		});

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
	 * Get panel
	 *
	 * @return resource
	 */
	public function getPanel()
	{
	    return $this->panel;
	}
	
	/**
	 * Set panel
	 *
	 * @param  resource $panel
	 * @return Window
	 */
	public function setPanel($panel)
	{
	    $this->panel = $panel;
	
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
	 * Get row
	 *
	 * @return int
	 */
	public function getRow()
	{
	    return $this->row;
	}
	
	/**
	 * Set row
	 *
	 * @param  int $row
	 * @return Window
	 */
	public function setRow($row)
	{
	    $this->row = $row;
	
	    return $this;
	}

	/**
	 * Get col
	 *
	 * @return int
	 */
	public function getCol()
	{
	    return $this->col;
	}
	
	/**
	 * Set col
	 *
	 * @param  int $col
	 * @return Window
	 */
	public function setCol($col)
	{
	    $this->col = $col;
	
	    return $this;
	}

	/**
	 * Get border_top
	 *
	 * @return mixed
	 */
	public function getBorderTop()
	{
	    return $this->border_top;
	}
	
	/**
	 * Set border_top
	 *
	 * @param  mixed $border_top
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
	 * @return mixed
	 */
	public function getBorderBottom()
	{
	    return $this->border_bottom;
	}
	
	/**
	 * Set border_bottom
	 *
	 * @param  mixed $border_bottom
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
	 * @return mixed
	 */
	public function getBorderLeft()
	{
	    return $this->border_left;
	}
	
	/**
	 * Set border_left
	 *
	 * @param  mixed $border_left
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
	 * @return mixed
	 */
	public function getBorderRight()
	{
	    return $this->border_right;
	}
	
	/**
	 * Set border_right
	 *
	 * @param  mixed $border_right
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
	 * @return mixed
	 */
	public function getBorderTopLeft()
	{
	    return $this->border_top_left;
	}
	
	/**
	 * Set border_top_left
	 *
	 * @param  mixed $border_top_left
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
	 * @return mixed
	 */
	public function getBorderTopRight()
	{
	    return $this->border_top_right;
	}
	
	/**
	 * Set border_top_right
	 *
	 * @param  mixed $border_top_right
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
	 * @return mixed
	 */
	public function getBorderBottomLeft()
	{
	    return $this->border_bottom_left;
	}
	
	/**
	 * Set border_bottom_left
	 *
	 * @param  mixed $border_bottom_left
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
	 * @return mixed
	 */
	public function getBorderBottomRight()
	{
	    return $this->border_bottom_right;
	}
	
	/**
	 * Set border_bottom_right
	 *
	 * @param  mixed $border_bottom_right
	 * @return Window
	 */
	public function setBorderBottomRight($border_bottom_right)
	{
	    $this->border_bottom_right = $border_bottom_right;
	
	    return $this;
	}
}