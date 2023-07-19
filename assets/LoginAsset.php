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
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'src/assets/vendors/base/vendors.bundle.css',
        'src/assets/demo/demo9/base/style.bundle.css',


    ];
    public $js = [
       
        'src/assets/vendors/base/vendors.bundle.js',
        'src/assets/demo/demo9/base/scripts.bundle.js',
    ];
    public $depends = [

    ];
}
