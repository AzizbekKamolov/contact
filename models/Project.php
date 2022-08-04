<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property float|null $budget_sum
 * @property string|null $project_year
 * @property int|null $user_id
 * @property int|null $status_id
 * @property string|null $deadline
 * @property int $created_at
 * @property int $updated_at
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['budget_sum'], 'number'],
            [['project_year', 'deadline'], 'safe'],
            [['user_id', 'status_id', 'created_at', 'updated_at', 'currency_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title', 'description'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'budget_sum' => 'Бюджет',
            'currency_id' => 'Тип валюты',
            'project_year' => 'Год проекта',
            'user_id' => 'Ответственный',
            'status_id' => 'Статус',
            'deadline' => 'Срок',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getContracts()
    {
        return $this->hasMany(Contract::className(), ['project_id' => 'id']);
    }

    public static function getProjects()
    {
        return ArrayHelper::map(Project::find()->all(), 'id', 'title');
    }

    public static function getProjectById($id)
    {
        return Project::find()->where(['id' => $id])->one();
    }

//    public static function getExpense($id)
//    {
//        $project = Project::find()->where(['id' => $id])->one();
//        $currencies = Currency::find()->all();
//        $contracts = Contract::find()->where(['project_id' => $id ])->all();
//        $tasks = Task::find()->where(['project_id' => $id])->all();
//
//        $sum = [
//            'UZS' => 0,
//            'USD' => 0,
//            'RUB' => 0
//        ];
//
//        foreach ($currencies as $currency) {
//            foreach ($contracts as $contract) {
//                if ($currency->id === $contract->currency_id) {
//                    $sum[$currency->short_name] += $contract->price;
//                }
//            }
//            foreach ($tasks as $task) {
//                if ($currency->id === $task->currency_id) {
//                    $sum[$currency->short_name] += $task->price;
//                }
//            }
//        }
//
//        $sum_keys = array_keys($sum);
//        $str = number_format($project->budget_sum, 2). ' ' . Currency::getCurrencyById($project->currency_id)->short_name . ' из них потрачено ';
//
//        for ($i = 0; $i < count($sum_keys); $i++){
//            if($sum[$sum_keys[$i]] !== 0){
//                $str .= number_format($sum[$sum_keys[$i]], 2) . ' ' . $sum_keys[$i] . ', ';
//            }
//        }
////        var_dump($str);die();
//        return $str;
//    }

    public static function getRemaider($id)
    {
        $project = Project::findOne($id);
        $contracts = Contract::find()->where(['project_id' => $id ])->all();
        $currencies = Currency::find()->all();
        $sum = 0;
        foreach ($currencies as $currency)
        {
            foreach ($contracts as $contract)
            {
                if ($currency->id === $contract->currency_id)
                {
                    $value = SystemVariables::find()->where(['key' => $currency->short_name])->one()->value;
                    $sum += (1 * $value) * $contract->price;
                }
            }
        }

        $remainder = $project->budget_sum - $sum;
        return $remainder;
    }

    public static function updateProjectStatus($project_id)
    {
        $project = Project::findOne($project_id);
        if ($project->status_id === 1)
        {
            $project->status_id = 5;
            $project->save(false);
        }
    }

}
