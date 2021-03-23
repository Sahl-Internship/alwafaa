<?php
/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 * @var yii\bootstrap4\ActiveForm $form
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */

?>
<?php //echo $form->errorSummary($model); ?>
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
        <?php echo $form->field($model, 'sub_title')->textInput() ?>
        </div>
    <div class="col-sm-4">
        <?php echo $form->field($model, 'zoom_link')->textInput(['maxlength' => true]) ?>
    </div>
</div>


<?php echo $form->field($model, 'description')->widget(
    \yii\imperavi\Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor'],
        'options' => [
            'minHeight' => 200,
            'maxHeight' => 200,
            'buttonSource' => true,
            'convertDivs' => false,
            'removeEmptyTags' => true,
        ],
    ]
) ?>

<?php echo $form->field($model, 'requirement')->widget(
    \yii\imperavi\Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor', 'video'],
        'options' => [
            'minHeight' => 200,
            'maxHeight' => 200,
            'buttonSource' => true,
            'convertDivs' => false,
            'removeEmptyTags' => true,
        ],
    ]
) ?>

<?php echo $form->field($model, 'target_student')->widget(
    \yii\imperavi\Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor', 'video'],
        'options' => [
            'minHeight' => 200,
            'maxHeight' => 200,
            'buttonSource' => true,
            'convertDivs' => false,
            'removeEmptyTags' => true,
        ],
    ]
) ?>

<?php echo $form->field($model, 'targeted_skills')->widget(
    \yii\imperavi\Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor', 'video'],
        'options' => [
            'minHeight' => 200,
            'maxHeight' => 200,
            'buttonSource' => true,
            'convertDivs' => false,
            'removeEmptyTags' => true,
        ],
    ]
) ?>

