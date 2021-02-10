<?php

/**
 * @var yii\web\View $this
 * @var common\models\Section $model
 */

$this->title = 'Create Section';
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
