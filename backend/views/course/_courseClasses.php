<?php
/**
 * @var yii\web\View $this
 * @var backend\models\CourseForm $model
 * @var yii\bootstrap4\ActiveForm $form
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */

use kartik\date\DatePicker;
use kartik\time\TimePicker;
use unclead\multipleinput\MultipleInput;


if (Yii::$app->controller->action->id == 'create') {
    $model->start_at = null;
    $model->end_at = null;
} else {
    $model->start_at = date('m/d/Y', $model->start_at);
    $model->end_at = date('m/d/Y', $model->end_at);
}
$days = [
    0 => Yii::t('common','Sunday'),
    1 => Yii::t('common','Monday'),
    2 => Yii::t('common','Tuesday'),
    3 => Yii::t('common','Wednesday'),
    4 => Yii::t('common','Thursday'),
    5 => Yii::t('common','Friday'),
    6 => Yii::t('common','Saturday'),
];
?>
<br><br>
<div class="row">
<?php
//echo '<label class="control-label">Select date range</label>';
//echo DatePicker::widget([
//    'model' => $model,
//    'attribute' => 'start_at',
//    'attribute2' => 'end_at',
//    'options' => [
//        'placeholder' => 'Start date',
//        'autocomplete' => 'off'
//    ],
//    'options2' => [
//        'placeholder' => 'End date',
//        'autocomplete' => 'off'
//    ],
//    'type' => DatePicker::TYPE_RANGE,
//    'form' => $form,
//    'pluginOptions' => [
//        'format' => 'yyyy-mm-dd',
//        'autoclose' => true,
//        'startDate' => "0d"
//    ]
//]);
//?>
    <div class="col-sm-6">

        <?php echo $form->field($model,'start_at')->widget(DatePicker::classname(), []); ?>
    </div>
    <div class="col-sm-6">
        <?php echo $form->field($model,'end_at')->widget(DatePicker::classname(), []); ?>
    </div>
</div>
<br><br>
<?php echo $form -> field($model, 'classes') -> widget(MultipleInput ::className(), [
    'max' => 7,
    'columns' => [
        [
            'name'=>'day_id',
            'type'  => 'dropDownList',
            'title'=>Yii::t('backend','Day'),
            'items' => $days,
            'options'=>[
                    'placeholder'=>'select day',
            ]
        ],
        [
            'name'  => 'from',
            'type'  => TimePicker::className(),
            'title' => Yii::t('backend','From'),
            'value' => function($data) {
                return date('h:i A', $data->from);
            },
        ],
        [
            'name'=>'to',
            'type'  => TimePicker::className(),
            'title'=>Yii::t('backend','To'),
            'value' => function($data) {
                return date('h:i A', $data->to);
            },
        ],
    ],
    'allowEmptyList'=>false,
    'enableGuessTitle'=>true,
//    'addButtonPosition'=>MultipleInput::POS_HEADER,
    'iconSource'=>MultipleInput::ICONS_SOURCE_FONTAWESOME,

])->label(false) ?>