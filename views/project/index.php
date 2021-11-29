<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Projects';
?>

<?php if (count($model)): ?>
    <?php foreach ($model as $item):?>
        <div class="alert alert-primary">
            <a href="<?= Url::toRoute(['project/view','id' => $item->id]) ; ?>">
                <h3><?= $item->title ?></h3>
            </a>
            <p><?= $item->description ?></p>
        </div>
    <?php endforeach;?>
<?php endif;?>