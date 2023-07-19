<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\dropdown\DropdownX;
$this->title = 'Sales';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .add-new{
        margin-top: 0px !important;
    }
</style>
<div class="sales-index">
    <?php  echo $this->render('_deparmtent_sale_search', ['model' => $searchModel]); ?>
    <?php
    ?>
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <div class="table-responsive">
                <div class="m-section">
                    <div class="m-section__content">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                            </div>
                            <div class="col-sm-6 text-right">
                                <div class="dt-buttons btn-group">
                                    <a href="<?= Yii::$app->homeUrl?>sales/department-sale-report?<?= $_SERVER['QUERY_STRING'];  ?>&print=true" class="btn btn-success buttons-print" tabindex="0" aria-controls="m_table_1"><span>Print</span></a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered m-table">
                            <thead>
                            <tr>
                                <th>
                                    Sno
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Total Tests
                                </th>
                                <th>
                                    Total Amount
                                </th>
                                <th>
                                    Total Discount
                                </th>
                                <th >
                                    Total Consultant
                                </th>
                                <th >
                                    Total
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $patient = 0;
                            $sum_tests = 0;
                            $sum_total_amount = 0;
                            $sum_discount = 0;
                            $sum_consultant_amount = 0;
                            $sum_grand_total = 0;
                            foreach ($dataProvider->models as $key=>$provider)
                            {
                                $grand_total = $provider->total_amount - $provider->total_discount;
                                $sum_grand_total = $sum_grand_total+$grand_total;
                                $sum_tests = $sum_tests + $provider->total_test;
                                $sum_total_amount = $sum_total_amount + $provider->total_amount;
                                $sum_discount = $sum_discount + $provider->total_discount;
                                $sum_consultant_amount = $sum_consultant_amount+ $provider->total_consultant;
                                $patient++
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?= $key + 1?>
                                    </th>
                                    <td>
                                        <?= $provider->item_category ?>
                                    </td>

                                    <td>
                                        <?= $provider->total_test?>
                                    </td>
                                    <td>
                                    <?= $provider->total_amount?>
                                    </td>
                                    <td>
                                        <?= $provider->total_discount?>
                                       
                                    </td>
                                    <td> 
                                        <?= $provider->total_consultant?>
                                    </td>
                                    <td> 
                                        <?= $grand_total?>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-4"></div>
            <div class="col-xl-3"></div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Stats2-1 -->
                <div class="m-widget1">
                    
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Total Test
                                </h3>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-brand">
                                    <?= number_format($sum_tests) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Tests Total Amount
                                </h3>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-brand">
                                    <?= number_format($sum_total_amount) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Consultant Amount
                                </h3>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">
                                    <?= number_format($sum_consultant_amount)?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Discounts
                                </h3>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">
                                    <?= number_format($sum_discount)?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Grand Total
                                </h3>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-success">
                                    <?= number_format($sum_grand_total)?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-1"></div>
        </div>
    </div>
</div>