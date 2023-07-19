<?php
/**
 * Created by PhpStorm.
 * User: Multiline
 * Date: 7/8/2018
 * Time: 2:19 PM
 */

\Yii::$container->set('kartik\grid\GridView', [
    'pager' => [
        'options'=>['class'=>'pagination'],   // set clas name used in ui list of pagination
        'linkOptions' => ['class' => 'page-link'],
        'activePageCssClass' => 'page-item active',
        'lastPageLabel' => 'Last',
        'disabledPageCssClass' => 'page-item disabled',
        'prevPageLabel' => ' Previous',
        'prevPageCssClass' => 'page-item',
        'nextPageCssClass' => 'page-item',
        'nextPageLabel' => ' Next',
    ],

    'hover' => true,
    'condensed' => true,
    'floatHeader' => false,
    'bordered'=>true,
    'striped'=>true,
    //'responsive'=>true,
    'responsiveWrap' => false,
]);