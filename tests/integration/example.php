<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * The ExampleScript class illustrates some of the CursedScript functionalities ; it can be run from the terminal with /application/run.php
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class ExampleScript extends \CursedScript\Script
{
	/**
	 * {@inheritDoc}
	 */
	public function init()
	{
		$this->getLogger()->setDir(__DIR__ . '/var/log');
	}

	/**
	 * {@inheritDoc}
	 */
	public function run()
	{
		throw new Exception("MyCustomException", 1);
		
	}
}