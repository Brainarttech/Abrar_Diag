<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>


<style>

    .mycustomclass{
        background-color: white;
    }


</style>

        <div class="m-grid m-grid--hor m-grid--root m-page">        
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop">
                <!-- BEGIN: Left Aside -->
                <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
                    <i class="la la-close"></i>
                </button>
                <!-- END: Left Aside -->
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title ">
                                    Dashboard
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-content">

                        <!--Begin::Section-->
                        <div class="m-portlet">
                            <div class="m-portlet__body  m-portlet__body--no-padding">
                                <div class="row m-row--no-padding m-row--col-separator-xl">
                                    <div class="col-xl-4">
                                        <!--begin:: Widgets/Stats2-1 -->
                                        <div class="m-widget1">
                                            <div class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div class="col">
                                                        <h3 class="m-widget1__title">
                                                            Employees
                                                        </h3>
                                                        <!-- <span class="m-widget1__desc">
                                                            Awerage Weekly Profit
                                                        </span> -->
                                                    </div>
                                                    <div class="col m--align-right">
                                                        <span class="m-widget1__number m--font-brand">
                                                            17
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div class="col">
                                                        <h3 class="m-widget1__title">
                                                            Leave Application
                                                        </h3>
                                                        <!-- <span class="m-widget1__desc">
                                                            Weekly Customer Orders
                                                        </span> -->
                                                    </div>
                                                    <div class="col m--align-right">
                                                        <span class="m-widget1__number m--font-danger">
                                                            18
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-widget1__item">
                                                <div class="row m-row--no-padding align-items-center">
                                                    <div class="col">
                                                        <h3 class="m-widget1__title">
                                                            Expense Request 
                                                        </h3>
                                                        <!-- <span class="m-widget1__desc">
                                                            System bugs and issues
                                                        </span> -->
                                                    </div>
                                                    <div class="col m--align-right">
                                                        <span class="m-widget1__number m--font-success">
                                                            2
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end:: Widgets/Stats2-1 -->
                                    </div>
                                    <div class="col-xl-4">
                                        <!--begin:: Widgets/Daily Sales-->
                                        <div class="m-widget14">
                                            <div class="m-widget14__header m--margin-bottom-30">
                                                <h3 class="m-widget14__title">
                                                    Graphical Representation
                                                </h3>
                                                <span class="m-widget14__desc">
                                                    Hover on each label for more detail
                                                </span>
                                            </div>
                                            <div class="m-widget14__chart" style="height:120px;">
                                                <canvas  id="m_chart_daily_sales"></canvas>
                                            </div>
                                        </div>
                                        <!--end:: Widgets/Daily Sales-->
                                    </div>
                                    <div class="col-xl-4">
                                        <!--begin:: Widgets/Profit Share-->
                                        <div class="m-widget14">
                                            <div class="m-widget14__header">
                                                <h3 class="m-widget14__title">
                                                    Graphical Representation
                                                </h3>
                                                <span class="m-widget14__desc">
                                                    Labels are mentioned aside
                                                </span>
                                            </div>
                                            <div class="row  align-items-center">
                                                <div class="col">
                                                    <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                                        <div class="m-widget14__stat">
                                                            37
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="m-widget14__legends">
                                                        <div class="m-widget14__legend">
                                                            <span class="m-widget14__legend-bullet m--bg-accent"></span>
                                                            <span class="m-widget14__legend-text">
                                                                17 Employees
                                                            </span>
                                                        </div>
                                                        <div class="m-widget14__legend">
                                                            <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                                            <span class="m-widget14__legend-text">
                                                                18 Leave
                                                            </span>
                                                        </div>
                                                        <div class="m-widget14__legend">
                                                            <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                                            <span class="m-widget14__legend-text">
                                                                2 Expense
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end:: Widgets/Profit Share-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Section-->
                    </div>
                </div>
            </div>
            <!-- end:: Body -->

        </div>



<!-- <div class="row">
 <div class="col-md-4">

     <button class="btn btn-primary"></button>

 </div>
    <div class="col-md-4">
        <button class="btn btn-warning "></button>

    </div>
    <div class="col-md-4">
        <button class="btn btn-primary"></button>

    </div>
</div>
<div class="site-index">

    <div class="jumbotron">
        <h1>Comming Soon!</h1>

        <p class="lead">Please Wait</p>
        
    </div>

</div> -->
