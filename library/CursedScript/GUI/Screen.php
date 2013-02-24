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

/**
 * The full screen container
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Screen extends Window
{
	/**
	 * Constructs the screen
	 */
	public function __construct()
	{
		parent::__construct(0, 0, 0, 0);
	}

	/**
	 * {@inheritDoc}
	 */
	public function border($left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner)
	{
		call_user_func_array('ncurses_border', func_get_args());

		$this->borders = func_get_args();

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function write($string, $y, $x)
	{
		ncurses_mvaddstr($y, $x, $string);

		return $this;
	}

	/**
	 * Paints the screen and its child windows
	 * 
	 * @return Screen
	 */
	public function paint()
	{
		ncurses_refresh();

		foreach ($this->children as $child){
			ncurses_wrefresh($child->getResource());
		}

		return $this;
	}
}