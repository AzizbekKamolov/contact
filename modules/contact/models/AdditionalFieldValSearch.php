<?php

namespace app\modules\contact\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contact\models\AdditionalFieldsValue;

/**
 * AdditionalFieldValSearch represents the model behind the search form of `app\models\AdditionalFieldsValue`.
 */
class AdditionalFieldValSearch extends AdditionalFieldsValue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [[ 'contact_id', 'additional_id'], 'string'],
            [['value', 'created_at', 'created_by'], 'safe'],
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
        $query = AdditionalFieldsValue::find()->joinWith(['main', 'additionalField', 'user']);

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
            'additional_fields_values.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'additional_fields.title', $this->additional_id])
            ->andFilterWhere(['like', 'main.title', $this->contact_id])
            ->andFilterWhere(['like', 'users.email', $this->created_by])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}
