<?php

namespace app\modules\contact\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contact\models\SubCategory;

/**
 * SubCategorySerach represents the model behind the search form of `app\models\SubCategory`.
 */
class SubCategorySearch extends SubCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['category_id', 'string'],
            [['title', 'info'], 'safe'],
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
        $query = SubCategory::find()->joinWith('category');

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
            'subcategory.id' => $this->id,
//            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'subcategory.title', $this->title])
            ->andFilterWhere(['like', 'category.title', $this->category_id])
            ->andFilterWhere(['like', 'subcategory.info', $this->info]);

        return $dataProvider;
    }
}
