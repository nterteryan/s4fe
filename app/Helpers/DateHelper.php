<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Facade;  

use App\Constants\Interval;

class DateHelperFacade extends Facade 
{
      public static function getFacadeAccessor()
      {
            return 'DateHelper';
      }
}

class DateHelper
{
	public static function now()
	{
		return (int) (microtime(true));
	}

	public static function from_date($date_time)
	{
		return self::format_date($date_time , "m.d.Y");
	}

	public static function format_date($date_time , $format = "")
    {
        $date_time = new \DateTime($date_time , new \DateTimeZone('UTC'));
        return $date_time->format($format);
    }

	public static function add_interval($date_time , $interval , $lead = 1)
	{
		$date_time = new \DateTime($date_time , new \DateTimeZone('UTC'));
		$date_time = self::add_date_time_interval($date_time , $interval , $lead);
		return $date_time->format('Y-m-d H:i:s');
	}

	public static function add_date_time_interval($date_time , $interval , $lead = 1)
	{
		switch ($interval) 
		{
			case Interval::$SECOND:
				$interval_str = 'PT'.$lead.'S';
				break;

			case Interval::$MINUTE:
				$interval_str = 'PT'.$lead.'M';
				break;

			case Interval::$HOUR:
				$interval_str = 'PT'.$lead.'H';
				break;

			case Interval::$DAY:
				$interval_str = 'P'.$lead.'D';
				break;	

			case Interval::$WEEK:
				$interval_str = 'P'.$lead.'W';
				break;

			case Interval::$MONTH:
				$interval_str = 'P'.$lead.'M';
				break;	
			
			case Interval::$YEAR:
				$interval_str = 'P'.$lead.'Y';
				break;
			
			default:
				$interval_str = 'P0D';
				break;
		}

		$date_time->add(new \DateInterval($interval_str));
		return $date_time;
	}

	public static function date_time_to_timestamp($date_time)
	{
		return strtotime($date_time->format("Y-m-d H:i:s"));
	}

	public static function timestamp_to_date_time($timestamp)
	{
		return new DateTime(gmdate('Y-m-d H:i:s' , $timestamp) , new \DateTimeZone('UTC'));
	}

	public static function timestamp_to_string($timestamp)
	{
		return gmdate('Y-m-d H:i:s' , $timestamp);
	}

	public static function get_next_midnight()
	{
		$next_midnight = gmmktime(0, 0, 0, gmdate('n'), gmdate('j') + 1);
		return $next_midnight;
	}

	public static function parse_date($format, $date_str, $return_format)
	{
		$date = date_create_from_format($format, $date_str);
		return date_format($date, $return_format);
	}

	public static function getDaysDifference($date) {
		$now = gmdate('U');
		$datediff = abs($now - $date);

		return round($datediff / (60 * 60 * 24));
	}
}