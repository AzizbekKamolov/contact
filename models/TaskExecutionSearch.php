<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaskExecution;

/**
 * TaskExecutionSearch represents the model behind the search form of `app\models\TaskExecution`.
 */
class TaskExecutionSearch extends TaskExecution
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'user_id', 'exe_user_id', 'status_id', 'mark', 'receive_user', 'created_at', 'updated_at'], 'integer'],
            [['info', 'title', 'done_date', 'receive_date'], 'safe'],
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
        $select = '
        exe.id AS id,
        exe.title AS title,
        exe.task_id AS task_id,
        exe.user_id AS user_id,
        exe.exe_user_id AS exe_user_id,
        exe.status_id AS status_id,
        exe.info AS info,
        exe.done_date AS done_date,
        exe.mark AS mark,
        exe.receive_date AS receive_date,
        exe.receive_user AS receive_user,
        exe.created_at AS created_at,
        exe.updated_at AS updated_at,';
//        exc.exe_user_id AS exc_user_id,
//        exc.rec_user_id AS exc_rec_user_id';

        $query = (new \yii\db\Query())
            ->select($select)
            ->leftJoin("task_exchange AS exc", "exe.id=exc.task_exe_id")
            ->from('task_execution AS exe')
        ;
//        $query = TaskExecution::find();

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

        if (User::getMyRole() === 'headOfDep') {
            $q = '(exe.user_id = :user_id OR exe.exe_user_id = :user_id OR exe.receive_user = :user_id OR exc.exe_user_id = :user_id OR exc.rec_user_id = :user_id)';
            $query->where($q, [
                'user_id' => \Yii::$app->user->id,
            ]);
        } elseif ((User::getMyRole() === "simpleUser") || (User::getMyRole() === "accountant")) {
            $q = '(exe.exe_user_id = :user_id OR exe.receive_user = :user_id OR exc.exe_user_id = :user_id OR exc.rec_user_id = :user_id)';
            $query->where($q, [
                'user_id' => \Yii::$app->user->id
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
            'exe_user_id' => $this->exe_user_id,
            'status_id' => $this->status_id,
            'done_date' => $this->done_date,
            'mark' => $this->mark,
            'receive_date' => $this->receive_date,
            'receive_user' => $this->receive_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'info', $this->info])
        ->andFilterWhere(['like', 'title', $this->title]);

        $query->groupBy('exe.id');
        return $dataProvider;
    }
}
