<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'budget_sum',
            'project_year',
            'user_id',
            'status_id',
            'deadline',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <table id="w0" class="table table-striped table-bordered detail-view">
        <tbody>
            <h2>Contracts</h2>
            <?php if (!empty($contracts)):?>
                <?php foreach ($contracts as $contract):?>
                    <tr>
                        <th>Contract Title</th>
                        <td>
                            <a href="<?= Url::toRoute(['contract/view','id' => $contract->id]) ; ?>">
                                <h3><?= $contract->title ?></h3>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <p class="text-danger">There are not any contracts:(</p>
                </tr>
            <?php endif;?>
        </tbody>
    </table>

</div>
