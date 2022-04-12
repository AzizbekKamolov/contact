<?php

namespace app\models;

use phpDocumentor\Reflection\FqsenResolver;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ContractExecution;

/**
 * ContractExecutionSearch represents the model behind the search form of `app\models\ContractExecution`.
 */
class ContractExecutionSearch extends ContractExecution
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'contract_id', 'user_id', 'exe_user_id', 'status_id', 'mark', 'receive_user', 'created_at', 'updated_at'], 'integer'],
            [['title', 'info', 'done_date', 'receive_date'], 'safe'],
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
        $query = ContractExecution::find();

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

        $contractExes = ContractExchange::find()
            ->orWhere(['exe_user_id' => \Yii::$app->user->id])
            ->orWhere(['rec_user_id' => \Yii::$app->user->id])
            ->select(['con_exe_id'])
            ->distinct()
            ->all();
//        var_dump($contracts);die();
        $str = ' ';
        foreach ($contractExes as $contractEx){
            $str .= 'id = ' . $contractEx->con_exe_id . ' or ';
        }
//        mb_substr($str ,4,-1);
//        var_dump($str);die();

//        if (User::getMyRole() === 'headOfDep'){
//            $query->where('(user_id = :user_id or exe_user_id = :user_id or receive_user = :user_id)', ['user_id'=>\Yii::$app->user->id]);
//        } elseif (User::getMyRole() === "simpleUser") {
//            $query->where('(exe_user_id = :user_id or receive_user = :user_id)', ['user_id'=>\Yii::$app->user->id]);
//        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'contract_id' => $this->contract_id,
            'user_id' => $this->user_id,
            'exe_user_id' => $this->exe_user_id,
            'receive_user' => $this->receive_user,
            'status_id' => $this->status_id,
            'done_date' => $this->done_date,
            'mark' => $this->mark,
            'receive_date' => $this->receive_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
