<?php
/**
* @var yii\web\View $this
* @var common\models\Course $model
* @var yii\bootstrap4\ActiveForm $form
* @var common\models\Section $sectionList
* @var common\models\User $teacherList
*/

use kartik\datetime\DateTimePicker;

?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<?php echo $form->field($model, 'description')->widget(
    \yii\imperavi\Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor', 'video'],
        'options' => [
            'minHeight' => 400,
            'maxHeight' => 400,
            'buttonSource' => true,
            'convertDivs' => false,
            'removeEmptyTags' => true,
        ],
    ]
) ?>
<?php echo $form->field($model, 'section_id')->dropdownList($sectionList) ?>
<?php echo $form->field($model, 'teacher_id')->dropdownList($teacherList) ?>
<?php echo $form->field($model, 'zoom_link')->textInput(['maxlength' => true]) ?>
    <?php echo $form->field($model, 'time')->widget(
        DateTimePicker::class,
        [
//            'type' => DateTimePicker::TYPE_INLINE,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd HH:mm:ss',
                'showMeridian' => true,
                'todayBtn' => true,
            ]
        ]
    ) ?>

<?php echo $form->field($model, 'duration')->textInput() ?>
