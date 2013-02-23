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
 * Represents a log level
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Log
{
	/**
	 * @var string
	 */
	protected $level;

	/**
	 * @var string
	 */
	protected $date;

	/**
	 * @var string
	 */
	protected $time;

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * @var string
	 */
	protected $channel;

	public function __construct($level, $data, $channel = 'info')
	{
		$this->setDate(date('d-m-Y'))
			 ->setTime(date('H:i:s'))
			 ->setChannel($channel)
			 ->setLevel($level)
			 ->setData($data);
		
		call_user_func(\CursedScript\Script::getInstance()->getLogger()->getHandle(), $this);
	}

	/**
	 * Returns a json representation of itself
	 * 
	 * @return string
	 */
	public function serialize()
	{
		$json = array();

	    foreach ($this as $property => $value) {
	        $json[$property] = $value;
	    }

	    return json_encode($json);
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

	/**
	 * Get channel
	 *
	 * @return string
	 */
	public function getChannel()
	{
	    return $this->channel;
	}
	
	/**
	 * Set channel
	 *
	 * @param  string $channel
	 * @return Log
	 */
	public function setChannel($channel)
	{
	    $this->channel = $channel;
	
	    return $this;
	}
}