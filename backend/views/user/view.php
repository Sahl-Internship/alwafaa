<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->getPublicIdentity();
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="card">
        <div class="card-header">
            <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn primary-btn']) ?>
            <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body p-0">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                   [
                        'attribute' =>  Yii::t('backend','Full Name'),
                        'value' => $model->userProfile->getFullName(),
                    ],
                    'username',
                    [
                        'attribute' =>  Yii::t('backend','Phone'),
                        'value' => "(".$model->userProfile->phone_key .")".$model->userProfile->phone,
                    ],
                    [
                        'attribute' => Yii::t('backend','Gender'),
                        'value' => $model->userProfile->gender($model->userProfile->gender),
                    ],
                    [
                        'attribute' => Yii::t('backend','Address'),
                        'value' => $model->userProfile->country ." - ". $model->userProfile->city,
                    ],
                    [
                        'attribute' => Yii::t('backend','Birth Date'),
                        'value' => date('d-m-Y',$model->userProfile->birthdate),
                        'format'=>'date'
                    ],
                    [
                        'attribute'=>'status',
                        'value'=> $model->statuses()[$model->status]


                    ],
                    'email:email',
                    'auth_key',
                    'created_at:datetime',
                    'updated_at:datetime',
                    'logged_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
