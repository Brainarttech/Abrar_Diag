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
class SaleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
        'src/assets/vendors/base/vendors.bundle.css',
        'src/assets/demo/demo9/base/style.bundle.css',
        'src/assets/vendors/custom/datatables/datatables.bundle.css',
        
        'sale/css/slick.css',
        'sale/css/bulma.css',
        'css/custom.css',
        'sale/css/model.css',
        'sale/css/mdKeyboard.css'
        
       
    ];
    public $js = [
        'sale/js/angular.min.js',
        'sale/js/angular-route.js',
        'sale/js/angular-sanitize.js',
        'sale/js/angular-typeahead.js',
        'src/assets/vendors/base/vendors.bundle.js',
        'src/assets/demo/demo9/base/scripts.bundle.js',
        'src/assets/vendors/custom/datatables/datatables.bundle.js',
        'sale/js/slick.min.js',
        'js/bootbox.min.js',
        'js/toastr.min.js',
		'js/pusher.min.js',
		'js/jquery.playSound.js',
        'js/custom.js',
        'sale/js/ngBootbox.min.js',
        'sale/js/ui-bootstrap-tpls-2.5.0.js',
        'sale/js/mdKeyboard.min.js',
        'sale/js/app.js',
        'sale/js/custom.js'
    ];
    public $depends = [
       
    ];
}
