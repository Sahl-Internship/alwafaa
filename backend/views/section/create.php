<?php

/**
 * @var yii\web\View $this
 * @var common\models\Section $model
 * @var array $managerList
 */

$this->title = Yii::t('backend','Create Section');
$this->params['breadcrumbs'][] = ['label' => ' / '.Yii::t('backend','Sections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'managerList' => $managerList
    ]) ?>

</div>
