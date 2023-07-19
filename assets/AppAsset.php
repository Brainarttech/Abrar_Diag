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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
        'src/assets/vendors/base/vendors.bundle.css',
        'src/assets/demo/demo9/base/style.bundle.css',
        'src/assets/vendors/custom/datatables/datatables.bundle.css',

       // '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        'css/custom.css',
        'reception/css/model.css',
        
       
    ];
    public $js = [
       
        'src/assets/vendors/base/vendors.bundle.js',
        'src/assets/demo/demo9/base/scripts.bundle.js',
        'src/assets/vendors/custom/datatables/datatables.bundle.js',
       // '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        'js/bootbox.min.js',
        'js/toastr.min.js',
        'js/pusher.min.js',
        'js/jquery-tooltip.js',
		'js/dashboard.js',
		'js/jquery.playSound.js',
        'js/custom.js?h8',
       
    ];
    public $depends = [
       
    ];
}
