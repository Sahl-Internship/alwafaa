<?php
/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 * @var yii\bootstrap4\ActiveForm $form
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;

?>
<?php echo $form->errorSummary($model); ?>
<div class="row">
    <div class="col-sm-4">
        <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->field($model, 'section_id')->dropdownList($sectionList) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->field($model, 'teacher_id')->dropdownList($teacherList) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
    <?php echo $form->field($model, 'duration')->textInput() ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->field($model, 'zoom_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-4">
        <?php echo DateTimePicker::widget([
        'model'=>$model,
        'attribute'=>'time',
        'value'=> date('Y-m-d H:i:s', $model->time),
    //    'options'=>[],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd HH:mm:ss',
            'showMeridian' => true,
            'todayBtn' => true,
        ]
    ]); ?>
    </div>

</div>

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
<?php
$model->time =  date('m/d/Y', $model->time);
echo $form->field($model, 'time')->widget(DatePicker::classname(), []);
?>
<?php echo $form->field($model, 'duration')->textInput() ?>
