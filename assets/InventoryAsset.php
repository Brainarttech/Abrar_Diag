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
class InventoryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
        'src/assets/vendors/base/vendors.bundle.css',
        'src/assets/demo/demo9/base/style.bundle.css',
        'src/assets/vendors/custom/datatables/datatables.bundle.css',
        
        'purchase-inventory/css/slick.css',
        'purchase-inventory/css/bulma.css',
        'css/custom.css',
        'purchase-inventory/css/model.css',
        'purchase-inventory/css/mdKeyboard.css'
        
       
    ];
    public $js = [
        'purchase-inventory/js/angular.min.js',
        'purchase-inventory/js/angular-route.js',
        'purchase-inventory/js/angular-sanitize.js',
        'purchase-inventory/js/angular-typeahead.js',
        'src/assets/vendors/base/vendors.bundle.js',
        'src/assets/demo/demo9/base/scripts.bundle.js',
        'src/assets/vendors/custom/datatables/datatables.bundle.js',
        'purchase-inventory/js/slick.min.js',
        'js/bootbox.min.js',
        'js/toastr.min.js',
        'js/custom.js',
        'purchase-inventory/js/ngBootbox.min.js',
        'purchase-inventory/js/ui-bootstrap-tpls-2.5.0.js',
        'purchase-inventory/js/mdKeyboard.min.js',
        'purchase-inventory/js/app.js',
        'purchase-inventory/js/custom.js'
    ];
    public $depends = [
       
    ];
}
