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
use \CursedScript\Shell\Cursor;
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
		$this->setIni(dirname(__DIR__) . '/settings.ini');
	}

	/**
	 * {@inheritDoc}
	 */
	public function run()
	{
		$screen = new Screen();
		$screen->border();

		$window = new Window(6, 60, 2, 2);
		$window->border();

		$cursor = new Cursor($window);
		$cursor->write('Press "F1" to quit');

		$screen->add($window);

		$this->paint($screen);

		$string = Keyboard::string(array(GUI::KEY_F1));

		$cursor->setRow(1);
		$cursor->write($string);

		$this->paint($screen);
	}
}