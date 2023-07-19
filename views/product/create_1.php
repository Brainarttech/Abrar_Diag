<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <div class="row">
        <div class="container">


            <h1><?= Html::encode($this->title) ?></h1>

            <?=
            $this->render('_form_1', [
                'model' => $model,
                'warehouses' => $warehouses,
            ])
            ?>
        </div>
    </div>
</div>
