<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventory;

/**
 * InventorySearch represents the model behind the search form of `app\models\Inventory`.
 */
class InventorySearch extends Inventory {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'quantity', 'purchase_id', 'variant_id', 'product_id', 'unit_id', 'sale_unit_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['cost_price', 'sale_price', 'discount', 'tax'], 'number'],
            [['created_on', 'updated_on'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Inventory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cost_price' => $this->cost_price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'purchase_id' => $this->purchase_id,
            'variant_id' => $this->variant_id,
            'product_id' => $this->product_id,
            'unit_id' => $this->unit_id,
            'sale_unit_id' => $this->sale_unit_id,
            'tax' => $this->tax,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
        ]);
        if (Yii::$app->user->identity->role != "Admin") {
            $query->andFilterWhere(['status' => '1']);
        }
        return $dataProvider;
    }

}
