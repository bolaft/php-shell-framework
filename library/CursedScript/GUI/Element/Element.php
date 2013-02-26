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

use \CursedScript\GUI\Theme\Visual;
use \CursedScript\GUI\Window;

/**
 * The parent class of all GUI elements
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
abstract class Element extends Visual implements GUI
{
	/**
	 * @var Window
	 */
	protected $window;

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
	 * @return Element
	 */
	public function setWindow(Window $window)
	{
	    $this->window = $window;
	
	    return $this;
	}
}