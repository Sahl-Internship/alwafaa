<?php

use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\Homework $model
 */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Homeworks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-view">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'fullName',
                    'email',
                    [
                        'attribute' =>  Yii::t('backend','Phone'),
                        'value' => "(".$model->userProfile->phone_key .")".$model->userProfile->phone,
                    ],
                    [
                        'attribute' => Yii::t('backend','Gender'),
                        'value' => $model->userProfile->getGender($model->userProfile->gender),
                    ],
                    [
                        'attribute' => Yii::t('backend','Address'),
                        'value' => $model->userProfile->country ." - ". $model->userProfile->city,
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><?php echo Yii::t('backend','Homeworks') ?></h2>
        </div>
        <div class="card-body">
            <?php if(isset($files)): ?>
                <?php foreach ($files as $file): ?>
                    <iframe src="<?php echo $file?>" style="width:450px; height:500px;" frameborder="1"></iframe>
                <?php endforeach; ?>
            <?php else : ?>
                <h3><?php echo Yii::t('backend','There are no Homeworks') ?></h3>
            <?php endif; ?>

        </div>
    </div>
</div>



