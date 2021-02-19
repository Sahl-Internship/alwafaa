<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\assets\bt;
use yii\web\JqueryAsset;
/**
 * This asset bundle provides the [jQuery](http://jquery.com/) JavaScript library.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JqAsset extends JqueryAsset
{
    public $sourcePath = '@npm/jquery/dist';
    public $js = [
        'jquery.js',
    ];
}