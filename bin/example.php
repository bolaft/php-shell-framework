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
		// Creates the non-library CronManager
		$cron_manager = new CronManager();
		$crons = $cron_manager->getCronList();

		/*===================================
		=            CRON SCREEN            =
		===================================*/
		
		// Creates the cron screen
		$cron_screen = new Screen();		
		
		/*==========  CRON LIST PANEL  ==========*/

		// Creates the cron selector; it will populate from the $crons array
		$cron_selector = new Selector(
			function(Selector $selector) use ($crons){
				$items = array();

				foreach ($crons as $name => $data){
					$items[] = new Item($data, $name);
				}

				return $items;
			}
		);

		// Adds listeners to the script
		$this->add(array(
			// The cron selector will switch to the next item on TAB and ARROW DOWN ...
			new Trigger(array(Keyboard::TAB, Keyboard::ARROW_DOWN), function () use ($cron_selector){
				$cron_selector->next();
			}),
			// ... and to the previous item on ARROW UP
			new Trigger(Keyboard::ARROW_UP, function () use ($cron_selector){
				$cron_selector->previous();
			}),
		));

		// Creates the cron list panel
		$cron_list_panel = new Panel($cron_screen);
		$cron_list_panel->tag('list');

		// Adds a title and the cron selector to the cron panel
		$cron_list_panel->add(array(
			new Title('Cron List'),
			$cron_selector,
		));

		// Gets the unique id of the selector
		$selector_id = $cron_selector->getId();
		
		/*==========  CRON VIEW PANEL  ==========*/

		// Creates the cron view panel
		$cron_view_panel = new Panel($cron_screen);
		$cron_view_panel->tag('view');

		// Adds a title, a table and two buttons to the cron view panel
		$cron_view_panel->add(array(
			// Creates a title; it will change with the selected cron
			new Title(function(Title $title) use ($selector_id){
				return GUI::get($selector_id)->getSelected()
		                                     ->getLabel();
			}),

			// Creates a table, it will populate from the selected cron array
			new Table(function (Table $table) use ($selector_id){
				return GUI::get($selector_id)->getSelected()
		                                     ->getConcreteObject();
			}),

			// Creates a button; it will execute the cron 'command' value
			new Button(function(Button $button) use ($selector_id){
				$cron = GUI::get($selector_id)->getSelected()
		                                      ->getConcreteObject();
		        Script::getInstance()->execute($cron['command']);
			}, 'Execute'), 

			// Creates a button; it will call the cron manager 'remove' method on the cron
			new Button(function(Button $button) use ($selector_id, $cron_manager){
				$cron = GUI::get($selector_id)->getSelected()
		                                      ->getConcreteObject();
		        $cron_manager->remove($cron);
			}, 'Remove'), 
		));
		
		/*-----  End of CRON SCREEN  ------*/

		/*===================================
		=            MENU SCREEN            =
		===================================*/

		// Creates the menu screen
		$menu_screen = new Screen();

		/*==========  MENU PANEL  ==========*/

		// Creates the selector, with a fixed array of items
		$menu_selector = new Selector(array(
			new Item($cron_screen, 'Manage Crons'),
		));

		// Defines the "onSelect" trigger; it will switch the script's selected screen
		$menu_selector->onSelect(function(Selector $selector, Item $item){
			Script::getInstance()->select($item->getConcreteObject());
		});

		// Creates the menu panel
		$menu_panel = new Panel($menu_screen);
		$menu_panel->tag('menu');

		// Adds a title and the selector to the panel
		$menu_panel->add(array(
			new Title('Menu'),
			$menu_selector,
		));
		
		/*-----  End of MENU SCREEN  ------*/

		// Selects the menu screen and displays it to the terminal
		$this->select($menu_screen)
		     ->refresh();
	}
}

// Executes the test script
$script = new Example();

// Fake cron manager class
class CronManager
{
	public static $crons;

	public function __construct()
	{
		self::$crons = array(
			'update_something' => array(
				'command' => 'php /bin/todo/update_something.php',
				'frequency' => array(
					'day_of_week'  => '',
					'day_of_month' => '',
					'minutes'      => '',
					'hours'        => '',
					'month'        => '',
				),
			),
			'do_stuff' => array(
				'command' => 'php /bin/todo/do_stuff.php',
				'frequency' => array(
					'day_of_week'  => '',
					'day_of_month' => '',
					'minutes'      => '',
					'hours'        => '',
					'month'        => '',
				),
			),
			'update_everything' => array(
				'command' => 'php /bin/todo/update_everything.php',
				'frequency' => array(
					'day_of_week'  => '',
					'day_of_month' => '',
					'minutes'      => '',
					'hours'        => '',
					'month'        => '',
				),
			),
			'reload_data' => array(
				'command' => 'php /bin/todo/reload_data.php',
				'frequency' => array(
					'day_of_week'  => '',
					'day_of_month' => '',
					'minutes'      => '',
					'hours'        => '',
					'month'        => '',
				),
			),
		);
	}

	public function remove($cron)
	{
		unset(self::$crons[$cron]);
	}

	public function getCronList()
	{
		return self::$crons;
	}
}