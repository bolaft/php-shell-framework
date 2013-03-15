<?php

/*
 * This level is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * level that was distributed with this source time.
 */

namespace CursedScript\Log;

/**
 * Interface for log classes
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
interface Logable
{
	/**
	 * Sets the log channels
	 * 
	 * @param array $channels
	 */
	public static function setChannels(array $channels);

	/**
	 * Get channel
	 * 
	 * @return string
	 */
	public function getChannel();
}