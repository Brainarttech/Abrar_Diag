<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PosAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'src/assets/vendors/base/vendors.bundle.css',
        'src/assets/demo/demo9/base/style.bundle.css',
        'src/assets/vendors/custom/datatables/datatables.bundle.css',
        'reception/css/slick.css',
        'reception/css/bulma.css',
        'css/custom.css',
        'reception/css/model.css',
        'reception/css/mdKeyboard.css'
    ];
    public $js = [
        'reception/js/angular.min.js',
        'reception/js/angular-route.js',
        'reception/js/angular-sanitize.js',
        'reception/js/angular-typeahead.js',
        'src/assets/vendors/base/vendors.bundle.js',
        'src/assets/demo/demo9/base/scripts.bundle.js',
        'src/assets/vendors/custom/datatables/datatables.bundle.js',
        'reception/js/slick.min.js',
        'js/bootbox.min.js',
        'js/toastr.min.js',
        'js/pusher.min.js',
        'js/jquery.playSound.js',
       // 'js/custom.js',
        'reception/js/ngBootbox.min.js',
        'reception/js/ui-bootstrap-tpls-2.5.0.js',
        'reception/js/mdKeyboard.min.js',
        'reception/js/app.js',
        'reception/js/custom.js'
    ];
    public $depends = ['app\assets\AppAsset'];
}
