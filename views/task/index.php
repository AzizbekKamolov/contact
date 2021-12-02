<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Tasks';
?>

<?php if (count($model)): ?>
    <?php foreach ($model as $item):?>
        <div class="alert alert-primary">
            <a href="<?= Url::toRoute(['task/view','id' => $item->id]) ; ?>">
                <h3><?= $item->title ?></h3>
            </a>
            <p><?= $item->price ?></p>
        </div>
    <?php endforeach;?>
<?php endif;?>