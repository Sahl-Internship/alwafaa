<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

// namespace yii\bootstrap;
namespace common\assets\bt;

use yii\web\AssetBundle;
use yii\bootstrap4\BootstrapPluginAsset;
/**
 * Asset bundle for the Twitter bootstrap javascript files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapPlugin extends BootstrapPluginAsset
{
    public $sourcePath = '@npm/bootstrap/dist';
    public $js = [
        'js/bootstrap.js',
    ];
    public $depends = [
        // 'yii\web\JqueryAsset',
        // 'yii\bootstrap\BootstrapAsset',
        'common\assets\bt\JqAsset',
        'common\assets\bt\BtAsset'
    ];
}