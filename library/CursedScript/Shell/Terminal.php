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

/**
 * Represents the user's terminal
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Terminal
{
	/**
	 * @var boolean
	 */
	protected $echo = false;

	/**
	 * @var boolean
	 */
	protected $raw = false;

	/**
	 * @var boolean
	 */
	protected $keypad = true;

	/**
	 * @var boolean
	 */
	protected $cursor = false;

	/**
	 * @var boolean
	 */
	protected $color = true;

	/**
	 * Apply terminal settings
	 *
	 * @param resource $ncurses
	 * @return Terminal
	 */
	public function apply()
	{
		$this->echo   ? ncurses_echo()      : ncurses_noecho();
		$this->raw    ? ncurses_raw()       : ncurses_cbreak();
		$this->cursor ? ncurses_curs_set(1) : ncurses_curs_set(0);

		if ($this->color) ncurses_start_color();
		
		ncurses_keypad(STDSCR, $this->keypad);

		return $this;
	}

	/**
	 * Flashes the terminal
	 * 
	 * @return Terminal
	 */
	public function flash()
	{
		ncurses_flash();

		return $this;
	}

	/**
	 * Checks for color support
	 * 
	 * @return boolean
	 */
	public function hasColors()
	{
		return ncurses_has_colors();
	}

	/**
	 * Get echo
	 *
	 * @return boolean
	 */
	public function getEcho()
	{
	    return $this->echo;
	}
	
	/**
	 * Set echo
	 *
	 * @param  boolean $echo
	 * @return Terminal
	 */
	public function setEcho($echo)
	{
	    $this->echo = $echo;
	
	    return $this;
	}

	/**
	 * Get raw
	 *
	 * @return boolean
	 */
	public function getRaw()
	{
	    return $this->raw;
	}
	
	/**
	 * Set raw
	 *
	 * @param  boolean $raw
	 * @return Terminal
	 */
	public function setRaw($raw)
	{
	    $this->raw = $raw;
	
	    return $this;
	}

	/**
	 * Get keypad
	 *
	 * @return boolean
	 */
	public function getKeypad()
	{
	    return $this->keypad;
	}
	
	/**
	 * Set keypad
	 *
	 * @param  boolean $keypad
	 * @return Terminal
	 */
	public function setKeypad($keypad)
	{
	    $this->keypad = $keypad;
	
	    return $this;
	}

	/**
	 * Get cursor
	 *
	 * @return boolean
	 */
	public function getCursor()
	{
	    return $this->cursor;
	}
	
	/**
	 * Set cursor
	 *
	 * @param  boolean $cursor
	 * @return Terminal
	 */
	public function setCursor($cursor)
	{
	    $this->cursor = $cursor;
	
	    return $this;
	}

	/**
	 * Get color
	 *
	 * @return boolean
	 */
	public function getColor()
	{
	    return $this->color;
	}
	
	/**
	 * Set color
	 *
	 * @param  boolean $color
	 * @return Terminal
	 */
	public function setColor($color)
	{
	    $this->color = $color;
	
	    return $this;
	}
}