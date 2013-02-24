<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use \CursedScript\Script;
use \CursedScript\GUI;
use \CursedScript\Shell\Input\Keyboard;
/**
 * The ExampleScript class illustrates some of the CursedScript functionalities ; it can be run from the terminal with /application/run.php
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class ExampleScript extends Script
{
	/**
	 * {@inheritDoc}
	 */
	public function init()
	{
		$this->setIni(__DIR__ . '/settings.ini');
	}

	/**
	 * {@inheritDoc}
	 */
	public function run()
	{
		$screen = new GUI\Screen();
		$screen->border(0, 0, 0, 0, 0, 0, 0, 0);

		$window = new GUI\Window(10, 30, 7, 25);
		$window->border(0, 0, 0, 0, 0, 0, 0, 0);
		$window->write('MyWindow', 1, 1);

		$screen->addChild($window);
		$screen->paint();

		$input = Keyboard::input();
	}
}