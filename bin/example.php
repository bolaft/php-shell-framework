<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

include_once '../app/bootstrap.php';

use \CursedScript\Script;
use \CursedScript\Shell\Cursor;
use \CursedScript\GUI\GUI;
use \CursedScript\GUI\Screen;
use \CursedScript\GUI\Window;
use \CursedScript\Shell\Input\Keyboard;

/**
 * The Example class illustrates some of the CursedScript functionalities ; it can be run from the terminal with /application/run.php
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Example extends Script
{
	/**
	 * {@inheritDoc}
	 */
	public function init()
	{
		$this->setIni(ROOT_PATH . 'app/settings/settings.ini');
		$this->log_handler->setDir(ROOT_PATH . 'var/log');
	}

	/**
	 * {@inheritDoc}
	 */
	public function run()
	{
		$this->test1();
	}

	private function test1()
	{
		$window_1_1 = new Window(6, 60, 2, 2);
		$window_1_1->border();

		$cursor_1_1_1 = new Cursor($window_1_1);
		$cursor_1_1_1->write('Type something then press "F1"');

		$screen_1 = new Screen();
		$screen_1->add($window_1_1);

		$this->select($screen_1)
		     ->refresh();

		$string = Keyboard::string(GUI::KEY_F1);

		$cursor_1_1_1->write('You wrote "' . $string . '", press any key to continue');

		$this->refresh();

		Keyboard::input();

		$window_2_1 = new Window(8, 60, 5, 5);
		$window_2_1->border();

		$cursor_2_1_1 = new Cursor($window_2_1);
		$cursor_2_1_1->write('This is a new window. Press any key to quit.');
		
		$screen_2 = new Screen();
		$screen_2->add($window_2_1);

		$this->select($screen_2)
		     ->refresh();

		Keyboard::input();

		$cursor_1_1_1->write('ADDENDUM');

		$this->select($screen_1)
		     ->refresh();

		Keyboard::input();
	}

	private function test2()
	{
		$screen_1 = new Screen();

		$this->select($screen_1);

		$window_1_1 = new Window(16, 60, 2, 5);
		$window_1_1->border()->show();

		$cursor_1_1_1 = new Cursor($window_1_1);
		$cursor_1_1_1->write('Window 1 - 1');

		$window_1_2 = new Window(16, 60, 5, 10);
		$window_1_2->border()->show();

		$cursor_1_2_1 = new Cursor($window_1_2);
		$cursor_1_2_1->write('Window 1 - 2');

		$screen_1->add($window_1_1)
		         ->add($window_1_2);

        $window_1_1->top();

		$screen_2 = new Screen();

		$window_2_1 = new Window(16, 60, 8, 15);
		$window_2_1->border();

		$cursor_2_1_1 = new Cursor($window_2_1);
		$cursor_2_1_1->write('Window 2 - 1');

		$screen_2->add($window_2_1);

        $this->refresh();

		Keyboard::input();
	}

	private function test3()
	{
		
	}
}

// Executing the test script
$script = new Example();