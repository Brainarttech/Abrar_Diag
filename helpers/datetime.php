<?php
/**
 * Created by PhpStorm.
 * User: Multiline
 * Date: 7/13/2018
 * Time: 3:57 PM
 */

namespace app\helpers;


Class datetime{

    public static function printBill($dateTime)
    {

        $phpdate = strtotime( $dateTime );
        $mysqldate = date( 'd-m-Y h:i A', $phpdate );
        
        return $mysqldate;
        
    }

    public static function printBillReportDelivery($dateTime)
    {

        //Add 24 Hours Format
        $phpdate = strtotime( $dateTime.' +1 day');
        $mysqldate = date( 'd-m-Y h:i A', $phpdate );

        return $mysqldate;

    }

    public static function saleDateTime($dateTime)
    {
        $phpdate = strtotime( $dateTime );
        $date = date( 'd/m/Y', $phpdate );
        $time = date('h:i A',$phpdate);

        return $date.'<br>'.$time;
    }
    public static function saleTime($dateTime)
    {
        $phpdate = strtotime( $dateTime );
        //$date = date( 'd/m/Y', $phpdate );
        $time = date('h:i A',$phpdate);

        return $time;
    }

    public static function saleItemDateTime($dateTime)
    {
        $phpdate = strtotime( $dateTime );
        $date = date( 'd/m/Y', $phpdate );
        $time = date('h:i A',$phpdate);

        return $date.' '.$time;
    }
	
	public static function HourMinuteSeconds($startTime, $endTime)
    {
		//return 'HourMinuteSeconds';
		$delta_time = strtotime($endTime) - strtotime($startTime);
		$hours = floor($delta_time / 3600);
		if(strlen($hours)<2)$hours = "0".$hours;
		$delta_time %= 3600;
		$minutes = floor($delta_time / 60);
		if(strlen($minutes)<2)$minutes = "0".$minutes;
		$seconds = $delta_time%60;
		if(strlen($seconds)<2)$seconds = "0".$seconds;
		return "{$hours}:{$minutes}:{$seconds}";
	}

    function countDays($year, $month, $ignore) {
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }
        return $count;
    }
	
	public static function getDate($dateTime)
    {
        $date = date_create($dateTime);
        return date_format($date, 'jS F Y');
    }
    //echo countDays(2013, 1, array(0,6)); // 23 //0 is sunday, ..., 6 is saturday.																		   
}

?>



