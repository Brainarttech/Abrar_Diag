<?= $form->field($model, 'credit')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'acType')->dropDownList(['0'=>'With Draw','1'=>'Deposit'],['prompt' => 'Select Method']) ?>


<?= $form->field($model, 'charts_of_accounts_id')->dropDownList(ArrayHelper::map(\app\models\ChartsOfAccounts::find()->all(), 'id', 'account_name'),['prompt' => 'Select Category'])

ArrayHelper::map(\app\models\ChartsOfAccounts::find()->all(), 'id', 'account_name')


echo $form->field($model, 'cat')->dropDownList($catList, ['id'=>'cat-id']);
 
// Child # 1
echo $form->field($model, 'subcat')->widget(DepDrop::classname(), [
    'options'=>['id'=>'subcat-id'],
    'pluginOptions'=>[
        'depends'=>['cat-id'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/site/subcat'])
    ]
]);
 
// THE CONTROLLER
public function actionSubcat() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = self::getSubCatList($cat_id); 
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
            echo Json::encode(['output'=>$out, 'selected'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
}

 ?>