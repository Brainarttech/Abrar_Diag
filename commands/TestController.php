<?php

//namespace console\controllers;

//use yii\console\Controller;

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

use app\helpers\Helper;

/**
 * Test controller
 */
class TestController extends Controller {

    public function actionIndex() {
		//echo date("Y-m-d");
		Helper::AttendanceApi(date("Y-m-d"), date("Y-m-d"));
        echo "cron service runnning";
    }

    public function actionMail($to) {
        echo "Sending mail to " . $to;
    }

}