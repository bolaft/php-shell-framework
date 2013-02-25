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

/**
 * Represents an element tag
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
abstract class Stylizable
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