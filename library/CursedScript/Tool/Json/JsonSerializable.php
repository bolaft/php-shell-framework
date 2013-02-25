<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Tool\Json;

/**
 * Interface for json serializable classes
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
interface JsonSerializable
{
    /**
     * Returns a json representation of itself
     * 
     * @return string
     */
    public function toJson();
}