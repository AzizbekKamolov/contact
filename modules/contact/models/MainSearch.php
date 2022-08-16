<?php

namespace app\modules\contact\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contact\models\Main;

/**
 * MainSearch represents the model behind the search form of `app\models\Main`.
 */
class MainSearch extends Main
{

    public $title;
    public $info;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'owner_id'], 'integer'],
            [['prefix', 'firstname', 'lastname', 'title', 'company', 'phone', 'cellphone', 'phone2', 'address1', 'address2', 'po_box', 'zip_code', 'country', 'city', 'language', 'category', 'subcategory'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Main::find()->joinWith(['category', 'subCategory', 'user']);

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
            'owner_id' => $this->owner_id,
        ]);

        $query->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'cellphone', $this->cellphone])
            ->andFilterWhere(['like', 'phone2', $this->phone2])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'po_box', $this->po_box])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'category.title', $this->category])
            ->andFilterWhere(['like', 'subcategory.title', $this->subcategory]);

        return $dataProvider;
    }
}
