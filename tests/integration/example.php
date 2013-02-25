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
use \CursedScript\GUI\Screen;
use \CursedScript\GUI\Window;
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
		$screen = new Screen();

		$window = new Window(0, 50, 0, 0);
		$window->write('Yeah! My window!');

		$window2 = new Window(8, 30, 12, 60);
		$window2->write('Press "q" to exit');

		$screen->addChild($window);
		$screen->addChild($window2);
		$screen->paint();

		while (true){
			if (chr(Keyboard::input()) == 'q') break;
		}
	}
}