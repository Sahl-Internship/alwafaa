<?php

/**
 * @var yii\web\View $this
 * @var common\models\Section $model
 */

$this->title = 'Update Section: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="section-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
