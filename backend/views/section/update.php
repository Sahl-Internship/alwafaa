<?php

/**
 * @var yii\web\View $this
 * @var common\models\Section $model
 */

$this->title = Yii::t('backend','Update Section').': ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => ' / '.Yii::t('backend','Sections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','Update');
?>
<div class="section-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
