<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\Tool\FileSystem;

use \CursedScript\Tool\String\Format;

/**
 * Performs string operations
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Explorer
{
    /**
     * Finds a file and returns its contents
     * 
     * @param  string  $file_path
     * @param  boolean $active
     * @return array
     */
    public static function exploreFile($file_path, $active = false)
    {
    	Format::removeFilename($file_path);

		if (file_exists($file_path) 
			or ($active 
				and ((is_dir($dir_path = Format::removeFilename($file_path)) 
					or mkdir($dir_path))
				and fopen($file_path, 'x+')))){
			return file($file_path);
		} else {
			return false;
		}
	}

	/**
	 * Finds a directory and returns its contents
	 * 
	 * @param  string  $dir_path
	 * @param  string  $extension
	 * @param  boolean $active
	 * @return array
	 */
    public static function exploreDir($dir_path, $extension = null, $active = false)
    {
		if (substr($dir_path, -1) !== '/') $dir_path .= '/';

		$glob_filter = $dir_path . '*';

		if (!is_null($extension)) $glob_filter .= '.' . $extension;

		if ((file_exists($dir_path) 
				&& is_dir($dir_path))
			|| ($active 
				&& mkdir($dir_path))){
			return glob($glob_filter);
		} else {
			return false;
		}
	}
}