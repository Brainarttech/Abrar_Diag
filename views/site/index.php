<div class="m-grid__item m-grid__item--fluid m-wrapper">

    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Daily Sales-->
                        <div class="m-widget14">
                            <div class="m-widget14__header m--margin-bottom-30">
                                <h3 class="m-widget14__title">
                                    Daily Sales
                                </h3>
                                <span class="m-widget14__desc">
                                    Check out each collumn for more details
                                </span>
                            </div>
                            <div class="m-widget14__chart" style="height:120px;">
                                <canvas  class="m_chart_daily_sales"></canvas>
                            </div>
                        </div>
                        <!--end:: Widgets/Daily Sales-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Daily Sales-->
                        <div class="m-widget14">
                            <div class="m-widget14__header m--margin-bottom-30">
                                <h3 class="m-widget14__title">
                                    Weekly Sales
                                </h3>
                                <span class="m-widget14__desc">
                                    Check out each collumn for more details
                                </span>
                            </div>
                            <div class="m-widget14__chart" style="height:120px;">
                                <canvas  id="m_chart_weekly_sales"></canvas>
                            </div>
                        </div>
                        <!--end:: Widgets/Daily Sales-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Daily Sales-->
                        <div class="m-widget14">
                            <div class="m-widget14__header m--margin-bottom-30">
                                <h3 class="m-widget14__title">
                                    Monthly Sales
                                </h3>
                                <span class="m-widget14__desc">
                                    Check out each collumn for more details
                                </span>
                            </div>
                            <div class="m-widget14__chart" style="height:120px;">
                                <canvas  id="m_chart_monthly_sales"></canvas>
                            </div>
                        </div>
                        <!--end:: Widgets/Daily Sales-->
                    </div>
                </div>
            </div>
        </div>
        <!--End::Section-->
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-4">
                <!--begin:: Widgets/Blog-->
                <div class="m-portlet m-portlet--head-overlay m-portlet--full-height  m-portlet--rounded-force">
                    <div class="m-portlet__head m-portlet__head--fit-" style="margin-top:20px">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                    Sales
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget27 m-portlet-fit--sides">
                            <div class="m-widget27__pic" style="height: 84px;">
                                <img src="assets/app/media/img//bg/bg-4.jpg" alt="">

                                <div class="m-widget27__btn">
                                    <button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--bolder">
                                        Inclusive All Sales
                                    </button>
                                </div>
                            </div>
                            <div class="m-widget27__container">
                                <!-- begin::Nav pills -->
                                <ul class="m-widget27__nav-items nav nav-pills nav-fill" role="tablist">
                                    <li class="m-widget27__nav-item nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#m_personal_income_quater_1">
                                            Sales
                                        </a>
                                    </li>
                                    <li class="m-widget27__nav-item nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#m_personal_income_quater_2">
                                            Paid
                                        </a>
                                    </li>

                                </ul>
                                <!-- end::Nav pills --> 	  	 
                                <!-- begin::Tab Content -->
                                <div class="m-widget27__tab tab-content m-widget27--no-padding">
                                    <div id="m_personal_income_quater_1" class="tab-pane active">
                                        <div class="row  align-items-center">
                                            <div class="col">
                                                <div id="m_chart_personal_income_quater_1" class="m-widget27__chart" style="height: 160px">
                                                    <div class="m-widget27__stat">
                                                        <?= number_format(\app\models\Sales::find()->where(['status' => '1'])->count()); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="m-widget27__legends">
                                                    <div class="m-widget27__legend">
                                                        <span class="m-widget27__legend-bullet m--bg-accent"></span>
                                                        <span class="m-widget27__legend-text">
                                                            <?= number_format(\app\models\Sales::find()->where(['sale_status' => '1'])->andWhere(['status' => '1'])->count()); ?> <span style="font-size:10px">Completed</span> 
                                                        </span>

                                                    </div>
                                                    <div class="m-widget27__legend">
                                                        <span class="m-widget27__legend-bullet m--bg-warning"></span>
                                                        <span class="m-widget27__legend-text">
                                                            <?= number_format(\app\models\Sales::find()->where(['sale_status' => '3'])->andWhere(['status' => '1'])->count()); ?> <span style="font-size:10px">Partial Refund</span>
                                                        </span>
                                                    </div>
                                                    <div class="m-widget27__legend">
                                                        <span class="m-widget27__legend-bullet m--bg-brand"></span>
                                                        <span class="m-widget27__legend-text">
                                                            <?= number_format(\app\models\Sales::find()->where(['sale_status' => '2'])->andWhere(['status' => '1'])->count()); ?> <span style="font-size:10px">Full Refund</span>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="m_personal_income_quater_2" class="tab-pane fade">
                                        <div class="row  align-items-center">
                                            <div class="col">
                                                <div id="m_chart_personal_income_quater_2" class="m-widget27__chart" style="height: 160px">
                                                    <div class="m-widget27__stat">
                                                        <?= number_format(\app\models\Sales::find()->where(['payment_status' => '1'])->andWhere(['status' => '1'])->count()); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="m-widget27__legends">
                                                    <div class="m-widget27__legend">
                                                        <span class="m-widget27__legend-bullet m--bg-focus"></span>
                                                        <span class="m-widget27__legend-text">
                                                            <?= number_format(\app\models\Sales::find()->where(['payment_status' => '2'])->count()); ?> <span style="font-size:10px">Partial Payment</span>
                                                        </span>
                                                    </div>
                                                    <div class="m-widget27__legend">
                                                        <span class="m-widget27__legend-bullet m--bg-success"></span>
                                                        <span class="m-widget27__legend-text">
                                                            <?= number_format(\app\models\Sales::find()->where(['payment_status' => '0'])->andWhere(['status' => '1'])->count()); ?> <span style="font-size:10px">Due Payment</span>
                                                        </span>
                                                    </div>
                                                    <div class="m-widget27__legend">
                                                        <span class="m-widget27__legend-bullet m--bg-danger"></span>
                                                        <span class="m-widget27__legend-text">
                                                            <?= number_format(\app\models\Sales::find()->where(['depart_push_status' => '1'])->andWhere(['status' => '1'])->count()); ?> <span style="font-size:10px">Dep. Push</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end::Tab Content -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Blog-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets/Blog-->
                <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
                    <div class="m-portlet__head m-portlet__head--fit">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                    Finance Stats
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget28">
                            <div class="m-widget28__pic m-portlet-fit--sides"></div>
                            <div class="m-widget28__container" >
                                <!-- begin::Nav pills -->
                                <ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#menu11">
                                            <span>
                                                <i class="fa flaticon-pie-chart"></i>
                                            </span>
                                            <span>
                                                GMI Taxes
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu21">
                                            <span>
                                                <i class="fa flaticon-file-1"></i>
                                            </span>
                                            <span>
                                                IMT Invoice
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-widget28__nav-item nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#menu31">
                                            <span>
                                                <i class="fa flaticon-clipboard"></i>
                                            </span>
                                            <span>
                                                Main Notes
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- end::Nav pills --> 
                                <!-- begin::Tab Content -->
                                <div class="m-widget28__tab tab-content">
                                    <div id="menu11" class="m-widget28__tab-container tab-pane active">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Company Name
                                                </span>
                                                <span>
                                                    SLT Back-end Solutions
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    INE Number
                                                </span>
                                                <span>
                                                    D330-1234562546
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Total Charges
                                                </span>
                                                <span>
                                                    USD 1,250.000
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Project Description
                                                </span>
                                                <span>
                                                    Creating Back-end Components
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu21" class="m-widget28__tab-container tab-pane fade">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Project Description
                                                </span>
                                                <span>
                                                    Back-End Web Architecture
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Total Charges
                                                </span>
                                                <span>
                                                    USD 2,170.000
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    INE Number
                                                </span>
                                                <span>
                                                    D110-1234562546
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Company Name
                                                </span>
                                                <span>
                                                    SLT Back-end Solutions
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu31" class="m-widget28__tab-container tab-pane fade">
                                        <div class="m-widget28__tab-items">
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Total Charges
                                                </span>
                                                <span>
                                                    USD 3,450.000
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Project Description
                                                </span>
                                                <span>
                                                    Creating Back-end Components
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    Company Name
                                                </span>
                                                <span>
                                                    SLT Back-end Solutions
                                                </span>
                                            </div>
                                            <div class="m-widget28__tab-item">
                                                <span>
                                                    INE Number
                                                </span>
                                                <span>
                                                    D510-7431562548
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end::Tab Content -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Blog-->
            </div>
            <div class="col-xl-4">
                <!--begin:: Packages-->
                <div class="m-portlet m--bg-warning m-portlet--bordered-semi m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m--font-light">
                                    Packages
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Widget 29-->
                        <div class="m-widget29">
                            <div class="m-widget_content">
                                <h3 class="m-widget_content-title">
                                    Monthly Expense
                                </h3>
                                <div class="m-widget_content-items">
                                    <div class="m-widget_content-item" style="width:200px">
                                        <span>
                                            Total
                                        </span>
                                        <span class="m--font-accent">
                                            <?php
                                            $date_end = date("Y-m-d");
                                            $date_start = date('Y-m-d', strtotime($date_end . ' - 1 months'));
                                            $sum = \app\models\Expenses::find()->where(['between', 'created_on', $date_start, $date_end])->sum('amount');

                                            echo 'PKR ' . $sum;
                                            ?>
                                        </span>

                                    </div>
                                    <div class="m-widget_content-item">
                                        <span>
                                            Count
                                        </span>
                                        <span>
                                            <?= number_format(\app\models\Expenses::find()->where(['between', 'created_on', $date_start, $date_end])->count()); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget_content">
                                <h3 class="m-widget_content-title">
                                    Monthly Sale
                                </h3>
                                <div class="m-widget_content-items">
                                    <div class="m-widget_content-item" style="width:200px">
                                        <span>
                                            Total
                                        </span>
                                        <span class="m--font-accent">
                                            <?php
                                            $date_end = date("Y-m-d");
                                            $date_start = date('Y-m-d', strtotime($date_end . ' - 1 months'));
                                            $sum = \app\models\Sales::find()->where(['between', 'created_on', $date_start, $date_end])->sum('paid_amount');

                                            echo 'PKR ' . $sum;
                                            ?>
                                        </span>
                                    </div>
                                    <div class="m-widget_content-item">
                                        <span>
                                            Count
                                        </span>
                                        <span>
                                            <?= number_format(\app\models\Sales::find()->where(['payment_status' => '1'])->andWhere(['status' => '1'])->andWhere(['between', 'created_on', $date_start, $date_end])->count()); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget_content">
                                <h3 class="m-widget_content-title">
                                    Daily Sale
                                </h3>
                                <div class="m-widget_content-items">
                                    <div class="m-widget_content-item">
                                        <span>
                                            Total
                                        </span>
                                        <span class="m--font-accent">
                                            <?php
                                            $date_end = date("Y-m-d");
                                            $date_start = date('Y-m-d', strtotime($date_end . ' - 1 days'));
                                            $sum = \app\models\Sales::find()->where(['between', 'created_on', $date_start, $date_end])->sum('paid_amount');

                                            echo 'PKR ' . $sum;
                                            ?>
                                        </span>
                                    </div>
                                    <div class="m-widget_content-item">
                                        <span>
                                            Count
                                        </span>
                                        <span>
                                            <?= number_format(\app\models\Sales::find()->where(['payment_status' => '1'])->andWhere(['status' => '1'])->andWhere(['between', 'created_on', $date_start, $date_end])->count()); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Widget 29-->
                    </div>
                </div>
                <!--end:: Packages-->
            </div>
        </div>
        <!--End::Section-->
    </div>
</div>
<script>
    $(window).bind("load", function () {
        var e = $("#m_chart_weekly_sales");
        if (0 != e.length) {
            var t = {
                labels: [<?php
                                            foreach ($sales as $sale) {
                                                echo '"' . $sale['date'] . '"' . ',';
                                            }
                                            ?>],
                datasets: [{
                        backgroundColor: "#87CCA5",
                        data: [<?php
                                            foreach ($sales as $sale) {
                                                echo $sale['sales'] . ',';
                                            }
                                            ?>]
                    }, {
                        backgroundColor: "#f3f3fb",
                        data: [<?php
                                            foreach ($sales as $sale) {
                                                echo $sale['sales'] . ',';
                                            }
                                            ?>]
                    }]
            };
            new Chart(e, {
                type: "bar",
                data: t,
                options: {
                    title: {
                        display: !1
                    },
                    tooltips: {
                        intersect: !1,
                        mode: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: !1
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    barRadius: 4,
                    scales: {
                        xAxes: [{
                                display: !1,
                                gridLines: !1,
                                stacked: !0
                            }],
                        yAxes: [{
                                display: !1,
                                stacked: !0,
                                gridLines: !1
                            }]
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            })
        }
    });
</script>
<script>
    $(window).bind("load", function () {
        var e = $(".m_chart_daily_sales");
        if (0 != e.length) {
            var t = {
                labels: [<?php
                                            foreach ($daily_sales as $sale) {
                                                echo '"' . $sale['date'] . '"' . ',';
                                            }
                                            ?>],
                datasets: [{
                        backgroundColor: "#87CCA5",
                        data: [<?php
                                            foreach ($daily_sales as $sale) {
                                                echo $sale['sales'] . ',';
                                            }
                                            ?>]
                    }, {
                        backgroundColor: "#f3f3fb",
                        data: [<?php
                                            foreach ($daily_sales as $sale) {
                                                echo $sale['sales'] . ',';
                                            }
                                            ?>]
                    }]
            };
            new Chart(e, {
                type: "bar",
                data: t,
                options: {
                    title: {
                        display: !1
                    },
                    tooltips: {
                        intersect: !1,
                        mode: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: !1
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    barRadius: 4,
                    scales: {
                        xAxes: [{
                                display: !1,
                                gridLines: !1,
                                stacked: !0
                            }],
                        yAxes: [{
                                display: !1,
                                stacked: !0,
                                gridLines: !1
                            }]
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            })
        }
    });
</script>
<script>
    $(window).bind("load", function () {
        var e = $("#m_chart_monthly_sales");
        if (0 != e.length) {
            var t = {
                labels: [<?php
                                            foreach ($monthly_sales as $sale) {
                                                echo '"' . $sale['date'] . '"' . ',';
                                            }
                                            ?>],
                datasets: [{
                        backgroundColor: "#87CCA5",
                        data: [<?php
                                            foreach ($monthly_sales as $sale) {
                                                echo $sale['sales'] . ',';
                                            }
                                            ?>]
                    }, {
                        backgroundColor: "#f3f3fb",
                        data: [<?php
                                            foreach ($monthly_sales as $sale) {
                                                echo $sale['sales'] . ',';
                                            }
                                            ?>]
                    }]
            };
            new Chart(e, {
                type: "bar",
                data: t,
                options: {
                    title: {
                        display: !1
                    },
                    tooltips: {
                        intersect: !1,
                        mode: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: !1
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    barRadius: 4,
                    scales: {
                        xAxes: [{
                                display: !1,
                                gridLines: !1,
                                stacked: !0
                            }],
                        yAxes: [{
                                display: !1,
                                stacked: !0,
                                gridLines: !1
                            }]
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            })
        }
    });
</script>