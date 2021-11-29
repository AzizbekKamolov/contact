<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class CustomAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/custom';

    public $css = [
        'css/styles.css?v=0.0.2',
    ];

    public $js = [
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
