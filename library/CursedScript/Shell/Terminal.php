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
	 * Apply terminal settings
	 *
	 * @param resource $ncurses
	 * @return Terminal
	 */
	public function apply()
	{
		$this->echo ? ncurses_echo() : ncurses_noecho();
		$this->raw  ? ncurses_raw()  : ncurses_cbreak();
		
		ncurses_keypad(STDSCR, $this->keypad);

		return $this;
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
}