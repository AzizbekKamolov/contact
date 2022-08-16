<?php

namespace app\modules\contact\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contact\models\AdditionalField;

/**
 * AdditionalFieldSearch represents the model behind the search form of `app\models\AdditionalField`.
 */
class AdditionalFieldSearch extends AdditionalField
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'multiple'], 'integer'],
            [['title', 'type'], 'safe'],
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
        $query = AdditionalField::find();

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
            'multiple' => $this->multiple,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
