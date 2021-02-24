<?php
/**
* @var yii\web\View $this
* @var common\models\Course $model
* @var yii\bootstrap4\ActiveForm $form
* @var common\models\Section $sectionList
* @var common\models\User $teacherList
*/

use kartik\datetime\DateTimePicker;
use unclead\multipleinput\MultipleInput;
use yii\bootstrap4\Html;

?>

<?= $form -> field($model, 'classes') -> widget(MultipleInput ::className(), [
    'max' => 20,
    'columns' => [
        [
            'name'=>'title',
            'title'=>Yii::t('backend','Class Title'),
        ],
        [
            'name'  => 'time',
            'type'  => DateTimePicker::className(),
            'title' => Yii::t('backend','Class Date'),
            'value' => function($data) {
                return date('Y-m-d H:i:s', $data['time']);
            },
            'items' => [
                '0' => 'Saturday',
                '1' => 'Monday'
            ],
            'options' => [
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd HH:mm:ss',
                    'todayHighlight' => true,
                    'showMeridian' => true,
                ]
            ]
        ],
        [
            'name'=>'duration',
            'title'=>Yii::t('backend','class Duration'),
            'options' => [
                'type' => 'number',
                'class' => 'input-priority',
            ]
        ],
    ],
    'allowEmptyList'=>false,
    'enableGuessTitle'=>true,
    'addButtonPosition'=>MultipleInput::POS_HEADER,
])->label(false) ?>

<div class="card-footer">
    <?php echo Html::submitButton($model->isNewRecord ?
        Yii::t('backend','Create') :
        Yii::t('backend','Update') ,
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

