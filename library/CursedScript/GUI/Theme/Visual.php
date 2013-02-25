<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\GUI\Theme;

use \CursedScript\GUI\GUI;

/**
 * Parent class of all stylizable objects
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
abstract class Visual implements GUI
{
	/**
	 * Style tags
	 * 
	 * @var string
	 */
	protected $tags;

	/**
	 * Get tags
	 * 
	 * @return string
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * Set tags
	 * 
	 * @param string $tags
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;

		return $this;
	}

	/**
	 * Get style class
	 *
	 * @return string
	 */
	abstract public function getStyleClass();
}