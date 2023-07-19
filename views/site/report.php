<?php
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use kartik\grid\GridView;
    use yii\helpers\Url;
    use yii\widgets\Pjax;
    use kartik\dropdown\DropdownX;
    use yii\widgets\ActiveForm;
    use kartik\select2\Select2;
    use app\models\ItemName;
    use app\models\ItemCategory;
    use kartik\date\DatePicker;
    use kartik\depdrop\DepDrop;
    /* @var $this yii\web\View */
    /* @var $searchModel app\models\SalesSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = 'Report Dignostics Tests';
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="department-index">
    <div class="m-portlet m-portlet--collapsed m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_7">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-search"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Search
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="#" data-pjax = 0  m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon">
                            <i class="la la-angle-down"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="item-name-search">
                <?php
                    $form = ActiveForm::begin([
                        'action' => ['report'],
                        'method' => 'get',
                        'options' => [
                            'data-pjax' => 1
                        ],
                    ]);
                ?>
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row">
                        <div class="col-md-2">
                            <?php
                                echo $form->field($searchModel, 'department_id')
                                    ->dropDownList(
                                        ArrayHelper::map(
                                            ItemCategory::find()->where(['status' => ItemCategory::STATUS_ACTIVE])->all(),
                                            'id',
                                            'name'
                                        ),
                                        [
                                            'id' => 'department-id',
                                            // 'options' => [
                                            //     '10'=> ['selected' => true ]
                                            // ]
                                        ]
                                    );
                            ?>
                        </div>
                        <div class="col-md-2">
                            <?php
                                echo $form->field($searchModel, 'item_id')->widget(DepDrop::classname(), [
                                    // 'data' => $items,
                                    'options' => [
                                        'placeholder' => 'Select Item Name',
                                        'id' => 'item-id'
                                        // 'value' => '635'
                                    ],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['department-id'],
                                        'url' => Url::to(['/site/items']),
                                        'loadingText' => 'Loading Item Name ...',
                                    ]
                                ]);
                            ?>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Date Ranges</label>
                                <div id="reportrange" class="btn default form-control">
                                    <i class="fa fa-calendar"></i>
                                    &nbsp;
                                    <span></span>
                                    <b class="fa fa-angle-down"></b>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;</label>
                            <div class="form-group">
                                <button type="button" id="search" class="btn btn-primary">Search</button>
                                <button type="button" id="print" class="btn btn-info">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="row m-row--full-height">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-brand ">
                <div class="m-portlet__body">
                    <div class="m-widget26">
                        <div class="m-widget26__number">
                            <span id="test-count"></span>
                            <small>
                                No of Tests
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m--space-30"></div>
            <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-danger ">
                <div class="m-portlet__body">
                    <div class="m-widget26">
                        <div class="m-widget26__number">
                            <span id="total-price"></span>
                            <small>
                                Total Price
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-success ">
                <div class="m-portlet__body">
                    <div class="m-widget26">
                        <div class="m-widget26__number">
                            <span id="item-name"></span>
                            <small>
                                Test Name
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m--space-30"></div>
            <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-accent ">
                <div class="m-portlet__body">
                    <div class="m-widget26">
                        <div class="m-widget26__number">
                            <span id="department-name"></span>
                            <small>
                                Department
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped- table-bordered table-hover table-checkable" id="sale_report">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Department</th>
                <th>item_name</th>
                <th>item_price</th>
                <th>date</th>
                <th>status</th>
                <th>complete date</th>
                <th>complete by</th>
            </tr>
        </thead>
    </table>
</div>

