<?php

/*
 * This code is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * code that was distributed with this source time.
 */

namespace CursedScript\Log;

use \CursedScript\Tool\Json\Serializable;

/**
 * Represents a log entry
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
class Log implements Logable, Serializable
{
	/**
	 * @var string
	 * @static
	 */
	public static $main_channel;

	/**
	 * @var string
	 * @static
	 */
	public static $info_channel;

	/**
	 * @var string
	 * @static
	 */
	public static $input_channel;

	/**
	 * @var string
	 * @static
	 */
	public static $warning_channel;

	/**
	 * @var string
	 * @static
	 */
	public static $exception_channel;

	/**
	 * @var string
	 * @static
	 */
	public static $error_channel;

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
	protected $channel;

	/**
	 * @var string
	 */
	protected $code;

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * @{inheritDoc}
	 */
	public static function setChannels(array $channels = array())
	{
		if(isset($channels['main']))      Log::$main_channel      = $channels['main'];
		if(isset($channels['info']))      Log::$info_channel      = $channels['info'];
		if(isset($channels['input']))     Log::$input_channel     = $channels['input'];
		if(isset($channels['warning']))   Log::$warning_channel   = $channels['warning'];
		if(isset($channels['exception'])) Log::$exception_channel = $channels['exception'];
		if(isset($channels['error']))     Log::$error_channel     = $channels['error'];
	}

	/**
	 * Constructor
	 * 
	 * @param int $code
	 * @param array  $data
	 * @param string $channel
	 */
	public function __construct($code, array $data, $channel = null)
	{
		$this->setDate(date('d-m-Y'))
			 ->setTime(date('H:i:s'))
			 ->setCode($code)
			 ->setData($data)
			 ->setChannel($channel);
		
		call_user_func(\CursedScript\Script::getInstance()->getLogHandler()->getHandle(), $this);
	}

	/**
	 * @{inheritDoc}
	 */
	public function toJson()
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
	 * Get code
	 *
	 * @return string
	 */
	public function getCode()
	{
	    return $this->code;
	}
	
	/**
	 * Set code
	 *
	 * @param  string $code
	 * @return Log
	 */
	public function setCode($code)
	{
	    $this->code = $code;
	
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
	public function setData(array $data)
	{
	    $this->data = $data;
	
	    return $this;
	}
}