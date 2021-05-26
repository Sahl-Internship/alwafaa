<?php

/**
 * @var yii\web\View $this
 * @var common\models\Tag $model
 */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => Yii::t('backend','Tag'),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
