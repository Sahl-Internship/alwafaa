<?php

/**
 * @var yii\web\View $this
 * @var common\models\StudentRequest $model
 */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Student Request',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Student Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-request-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
