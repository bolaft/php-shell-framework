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
	public function border($left = 0, $right = 0, $top = 0, $bottom = 0, $tl_corner = 0, $tr_corner = 0, $bl_corner = 0, $br_corner = 0)
	{
		$this->borders = array($left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner);

		call_user_func_array('ncurses_border', $this->borders);

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function write($string, $y = 1, $x = 1)
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