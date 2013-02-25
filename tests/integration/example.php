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
use \CursedScript\GUI\GUI;
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

		$y = 1;
		$x = 1;

		$new = function($y, $x) use ($screen){
			$window = new Window(6, 60, $y, $x);
			$window->write('Press "N" to open a new window or "Q" to quit');

			$screen->addChild($window);
			$screen->paint();
		};

		$new($y, $x);

		$key = Keyboard::input();

		while($key !== 'q'){
			if ($key == 'n'){
				$y++;
				$x++;
				$new($y, $x);
			}

			$key = Keyboard::input();
		};
	}
}