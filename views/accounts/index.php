<?php
use yii\helpers\Html;
$csrftoken = Yii::$app->request->getCsrfToken();
Yii::$app->view->registerJs('var csrftoken = "'.$csrftoken.'"',  \yii\web\View::POS_HEAD);
/* @var $this yii\web\View */
\app\assets\AccountAsset::register($this);

$this->title = 'Accounts';
?>

	<!--begin::Portlet-->
	<div class="m-portlet m-portlet--tabs">
		<div class="m-portlet__head">
			<div class="m-portlet__head-tools">
				<ul class="nav nav-tabs m-tabs-line m-tabs-line--danger m-tabs-line--2x m-tabs-line--left" role="tablist">
					<?php
					reset($dropDownOptions);
					$first = key($dropDownOptions);
					foreach($dropDownOptions as $Navkey => $element) {
						$count = 0;
						foreach($element[1] as $key => $counter) {
							$count += count($counter[chartsOfAccounts]);
						}	?>
						<li class="nav-item m-tabs__item">
							<?php if ($Navkey === $first)
							{
								echo '<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_portlet_base_demo_1_tab_content" role="tab">'.$element[0].'<span class="m-badge m-badge--secondary">'.$count.'</span>
								</a>';
								//count($element[1][0][chartsOfAccounts])
							}
							else
							{
								//echo $key;
								echo '<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_1_tab_content" role="tab">'.$element[0].'<span class="m-badge m-badge--secondary">'.$count.'</span>
								</a>';
								//count($element[1][0][chartsOfAccounts])
							}	    	
							?>
						</li>
					<?php } ?>
					<!-- <li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_1_tab_content" role="tab">
							Liability
							<span class="m-badge m-badge--secondary">2</span>
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_1_tab_content" role="tab">
							Equity
							<span class="m-badge m-badge--secondary">3</span>
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_1_tab_content" role="tab">
							Income
							<span class="m-badge m-badge--secondary">4</span>
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_1_tab_content" role="tab">
							Expense
							<span class="m-badge m-badge--secondary">5</span>
						</a>
					</li> -->
				</ul>
			</div>
		</div>
		<div class="m-portlet__body table_data">
			<p> fetching Data Please Wait..... </p>
		</div>
	</div>
	<!--end::Portlet-->