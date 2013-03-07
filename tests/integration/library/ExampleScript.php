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

		$window = new Window(6, 60, 2, 2);
		$window->border();

		$cursor = new Cursor($window);
		$cursor->setRow(1)
			   ->setCol(1)
		       ->write('Type something then press "F1"');

		$screen = new Screen();
		$screen->add($window);

		$this->display($screen);

		$string = Keyboard::string(GUI::KEY_F1);

		$cursor->setRow(2)
			   ->setCol(1)
		       ->write('You wrote "' . $string . '", press any key to continue');

		$screen->paint();

		Keyboard::input();

		$window2 = new Window(8, 60, 5, 5);
		$window2->border();

		$cursor2 = new Cursor($window2);
		$cursor2->setRow(1)
			    ->setCol(1)
		        ->write('This is a new window. Press any key to quit.');

		$screen2 = new Screen();
		$screen2->add($window2);

		$this->display($screen2);

		Keyboard::input();

		$this->display($screen);

		Keyboard::input();
	}
}