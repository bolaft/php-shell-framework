<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Exception;

use \CursedScript\GUI;
use \CursedScript\Shell\Cursor;

/**
 * The default exception screen
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Screen extends GUI\Screen implements ScreenInterface
{
	/**
	 * Constructor
	 *
	 * @param \Exception $exception
	 */
	public function __construct(\Exception $exception)
	{
		parent::__construct();

		$cursor = new Cursor($this);
		$cursor->write($error->getMessage());
	}
}