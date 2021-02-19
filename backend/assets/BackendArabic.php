<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;

use common\assets\AdminLte;
use common\assets\Html5shiv;
use yii\web\AssetBundle;
use yii\web\YiiAsset;
use rmrevin\yii\fontawesome\NpmFreeAssetBundle;

class BackendArabic extends AssetBundle
{
    /**
     * @var string
     */
//    public $sourcePath = '@backend/web/bundle';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /**
     * @var array
     */
    public $css = [
        
        '/css/super-dashboard.css',
        'https://use.fontawesome.com/releases/v5.7.2/css/all.css',
        'css/ar/style.css',
    ];
    /**
     * @var array
     */
    // public $js = [
    //     'js/app.js'
    // ];

    // public $publishOptions = [
    //     'only' => [
    //         '*.css',
    //         '*.js',
    //         '../img/*'
    //     ],
    //     "forceCopy" => YII_ENV_DEV,
    // ];

    /**
     * @var array
     */
    public $depends = [
        // YiiAsset::class,
        // AdminLte::class,
        // Html5shiv::class,
        'yii\web\YiiAsset',
        'common\assets\AdminLteAr',
        'common\assets\Html5shiv'
    ];
}
