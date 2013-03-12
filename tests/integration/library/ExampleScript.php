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
		$this->test3();
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
		$windows = array();
		$panels = array();
		$lines = 10;
		$cols = 40;
		$y = 2;
		$x = 4;

		/* Create windows for the panels */
		$windows[0] = ncurses_newwin($lines, $cols, $y, $x);
		$windows[1] = ncurses_newwin($lines, $cols, $y + 1, $x + 5);
		$windows[2] = ncurses_newwin($lines, $cols, $y + 2, $x + 10);

		/* 
		 * Create borders around the windows so that you can see the effect
		 * of panels
		 */
		for($i = 0; $i < 3; ++$i)
			ncurses_wborder($windows[$i], 0, 0, 0, 0, 0, 0, 0, 0);

		/* Attach a panel to each window */ 	/* Order is bottom up */
		$panels[0] = ncurses_new_panel($windows[0]); 	/* Push 0, order: stdscr-0 */
		$panels[1] = ncurses_new_panel($windows[1]); 	/* Push 1, order: stdscr-0-1 */
		$panels[2] = ncurses_new_panel($windows[2]); 	/* Push 2, order: stdscr-0-1-2 */

		/* Update the stacking order. 2nd panel will be on top */
		ncurses_update_panels();

		/* Show it on the screen */
		ncurses_doupdate();
		
		ncurses_getch();
	}

	private function test3()
	{
		$screen_1 = new Screen();

		$window_1_1 = new Window(16, 60, 2, 5);
		$window_1_1->border();

		$window_1_2 = new Window(16, 60, 5, 10);
		$window_1_2->border();

		$screen_1->add($window_1_1)
		         ->add($window_1_2);


		$this->select($screen_1)
		     ->refresh();

		Keyboard::input();
	}
}