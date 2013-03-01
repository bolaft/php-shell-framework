<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Shell;

use \CursedScript\GUI\Window;

/**
 * The cursor
 * 
 * @author Soufian Salim <soufi@nsal.im>
 */
class Cursor
{
	/**
	 * @var Window
	 */
	protected $window;

	/**
	 * @var int
	 */
	protected $row;

	/**
	 * @var int
	 */
	protected $col;

	/**
	 * Constructor
	 * 
	 * @param Window $window
	 */
	public function __construct(Window $window)
	{
		$this->window = $window;

		ncurses_getyx($this->window->getResource(), $this->row, $this->col);
	}

	/**
	 * Moves the cursor
	 * 
	 * @param  int $row
	 * @param  int $col
	 * @return Cursor
	 */
	public function move($row, $col)
	{
		$row = is_null($row) ? $this->row : $row;
		$col = is_null($col) ? $this->col : $col;

		ncurses_wmove($this->window->getResource(), $row, $col);

		$this->row = $row;
		$this->col = $col;

		return $this;
	}

	/**
	 * Writes a string at the given position
	 * 
	 * @param  string $string
	 * @param  int $row
	 * @param  int $col
	 * @return Cursor
	 */
	public function write($string, $row = null, $col = null)
	{
		$row = is_null($row) ? $this->row : $row;
		$col = is_null($col) ? $this->col : $col;

		ncurses_mvwaddstr($this->window->getResource(), $row, $col, $string);

		return $this;
	}

	/**
	 * Get window
	 *
	 * @return Window
	 */
	public function getWindow()
	{
	    return $this->window;
	}
	
	/**
	 * Set window
	 *
	 * @param  Window $window
	 * @return Cursor
	 */
	public function setWindow($window)
	{
	    $this->window = $window;
	
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
	 * @return Cursor
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
	 * @return Cursor
	 */
	public function setCol($col)
	{
	    $this->col = $col;
	
	    return $this;
	}
}