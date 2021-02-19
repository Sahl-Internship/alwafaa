<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/2/14
 * Time: 11:40 AM
 */

namespace common\assets;

use yii\web\AssetBundle;

class AdminLteAr extends AssetBundle
{
    public $sourcePath = '@common/assets/admin-lte/dist';

    public $js = [
        'js/app.min.js'
    ];

    public $css = [
        'bootstrap-rtl/css/bootstrap-rtl.css',
        'css/AdminLTE.min.css',
        'css/AdminLTE-rtl.min.css',
        'css/skins/_all-skins.min.css',
        'css/skins/_all-skins-rtl.min.css'
        
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        // 'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\bt\BootstrapPlugin',
        'common\assets\FontAwesome',
        'common\assets\JquerySlimScroll'
    ];
}
