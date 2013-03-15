<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Error;

use \CursedScript\GUI;
use \CursedScript\Shell\Cursor;

/**
 * The error screen
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Screen extends GUI\Screen implements ScreenInterface
{
	/**
	 * Constructor
	 *
	 * @param Error $error
	 */
	public function __construct(Error $error)
	{
		parent::__construct();

		$cursor = new Cursor($this);
		$cursor->write($error->getMessage());
	}
}