<?php

/*
 * This level is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * level that was distributed with this source time.
 */

namespace CursedScript\Debug\Log;

/**
 * Represents a log level
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Log
{
	/**
	 * @var string
	 */
	protected $date;

	/**
	 * @var string
	 */
	protected $time;

	/**
	 * @var string
	 */
	protected $level;

	/**
	 * @var array
	 */
	protected $data;

	public function serialize()
	{
		$json = array();

	    foreach ($this as $property => $value) {
	        $json[$property] = $value;
	    }

	    return json_encode($json);
	}

	/**
	 * Get date
	 *
	 * @return string
	 */
	public function getDate()
	{
	    return $this->date;
	}
	
	/**
	 * Set date
	 *
	 * @param  string $date
	 * @return Log
	 */
	public function setDate($date)
	{
	    $this->date = $date;
	
	    return $this;
	}

	/**
	 * Get time
	 *
	 * @return string
	 */
	public function getTime()
	{
	    return $this->time;
	}
	
	/**
	 * Set time
	 *
	 * @param  string $time
	 * @return Log
	 */
	public function setTime($time)
	{
	    $this->time = $time;
	
	    return $this;
	}

	/**
	 * Get level
	 *
	 * @return string
	 */
	public function getLevel()
	{
	    return $this->level;
	}
	
	/**
	 * Set level
	 *
	 * @param  string $level
	 * @return Log
	 */
	public function setLevel($level)
	{
	    $this->level = $level;
	
	    return $this;
	}

	/**
	 * Get data
	 *
	 * @return array
	 */
	public function getData()
	{
	    return $this->data;
	}
	
	/**
	 * Set data
	 *
	 * @param  array $data
	 * @return Log
	 */
	public function setData($data)
	{
	    $this->data = $data;
	
	    return $this;
	}
}