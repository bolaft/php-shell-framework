<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\GUI\Element\Form\Collection;

/**
 * Radio button for forms
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Radio extends Checkbox
{
	/**
	 * Get style class for stylization
	 */
	final public function getStyleClass()
	{
		return 'radio';
	}
}