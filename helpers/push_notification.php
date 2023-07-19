<?php

namespace app\helpers;
use Pusher\Pusher;

class push_notification
{
	public static $options = array(
		'cluster' => 'ap1',
		'useTLS' => true
	);
	
	public static $data = array(
		'message' => 'Hello World!'
	);
	
	public static $pusher;
	
	private static function setB() {
		if (!isset(self::$pusher)) {
			self::$pusher = new Pusher(
				'0bbec7c55f3b9be6c930',
				'0c54353f3bd3a4af4a49',
				'715651',
				self::$options
			);
		}
	}
	
	public  static function send_push_notification($department, $event)
    {
		self::setB();
		self::$pusher->trigger($department, $event, self::$data);
	}
}

?>