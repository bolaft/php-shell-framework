<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Shell\Input;

use \CursedScript\Exception\Exception;
use \CursedScript\Log\Log;

/**
 * Keyboard input
 * 
 * @author Soufian Salim <soufi@nsal.im>
 */
class Keyboard
{
	/**
	 * Wait for a key stroke and returns it
	 *
	 * @param  mixed $expected
	 * @return int
	 */
	public static function input($expected = null, $length = null)
	{
		$input = ncurses_getch();

		if (!is_null($expected)){
			if (is_string($expected)){
				$expected = array($expected);
			} 

			if (!is_array($expected)) {
				throw new Exception('The accepted argument types for "expected" are : array, string and null', 1);
			}

			while(!in_array($input, $expected)){
				$input = ncurses_getch();
			}
		}

		if (!is_null($length)){
			if (!is_int($length)){
				throw new Exception('The "length" parameter must be an integer', 1);
				
			}
			while (strlen($input) < $length){
				
			}
		}
		
		new Log('KEYBOARD_INPUT', array($input), Log::$input_channel);

		return $input;
	}
}