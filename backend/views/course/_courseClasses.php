<?php
/**
 * @var yii\web\View $this
 * @var backend\models\CourseForm $model
 * @var yii\bootstrap4\ActiveForm $form
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\time\TimePicker;
use unclead\multipleinput\MultipleInput;
use yii\bootstrap4\Html;


if (Yii::$app->controller->action->id == 'create') {
    $model->start_at = null;
    $model->end_at = null;
} else {
    $model->start_at = date('m/d/Y', $model->start_at);
    $model->end_at = date('m/d/Y', $model->end_at);
}
$days = [
    0 => 'Sunday',
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday'
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

<?php
//foreach ($days as $index => $day): ?>
<!--<div class="card">-->
<!--    <input type="checkbox" id="--><?php //echo 'day_' . $index ?><!--" onclick="myFunction('--><?php //echo $index;?>//')">
 <!--  <label for="myCheck"><?php //echo $day ?></label>-->
<!--</div>-->
<!---->
<!--    <div class="row" id="--><?php //echo 'class_' . $index ?><!--" style="display: none" >-->
<!--        <div class="col-sm-6">-->
<!--            --><?php //echo $form->field($model, 'from')->widget(TimePicker::classname(), [
//                'options' => [
//                    'placeholder' => 'From ...',
//                    'id' => 'from_' . $index,
//                    'name'=>'courseForm[classes]['.$index.'][from]'
//                ],
//                'pluginOptions'=>[
//                    'defaultTime' =>false,
//                ]
//            ])->label(false)?>
<!--        </div>-->
<!--        <div class="col-sm-6">-->
<!--            --><?php //echo $form->field($model, 'to')->widget(TimePicker::classname(), [
//                'options' => [
//                    'placeholder' => 'To ...',
//                    'id' => 'to_' . $index,
//                    'name'=>'courseForm[classes]['.$index.'][to]'
//                ],
//                'pluginOptions'=>[
//                       'defaultTime' =>false,
//                ]
//            ])->label(false)?>
<!--        </div>-->
<!--    </div>-->
<?php //endforeach; ?>
<!---->
<!---->
<!-- Try To Remove Option from Select-->
<!--<label for="cars">Choose a car:</label>-->
<!--<select name="cars" id="cars" onchange="yfun(--><?php //echo $days ?>//)">
//    <?php
//    foreach ($days as $day) :?>
<!--    <option value="--><?php //echo $day ?><!--">--><?php //echo $day ?><!--</option>-->
<!--    --><?php //endforeach; ?>
<!--</select>-->
<!---->

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
                return date('H:i:A', $data->from);
            },
        ],
        [
            'name'=>'to',
            'type'  => TimePicker::className(),
            'title'=>Yii::t('backend','To'),
            'value' => function($data) {
                return date('H:i:A', $data->to);
            },
        ],
    ],
    'allowEmptyList'=>false,
    'enableGuessTitle'=>true,
    'addButtonPosition'=>MultipleInput::POS_HEADER,
])->label(false) ?>


<script>

    function yfun(days) {
        let optionValue = document.getElementById("cars").value;
        console.log(optionValue)
        days=days.filter(day =>day!)
    }

    function myFunction(e) {
        // Get the checkbox
        // const id = e.target.attributes.id.value;
        // const class_id = id.split('_')[1]
// console.log(class_id)
// console.log(e.target.attributes.id.value)
        let checkBox = document.getElementById(`day_${e}`);
        // Get the output text
        let classes = document.getElementById(`class_${e}`);

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true) {
            classes.style.display = "flex";

        } else {
            classes.style.display = "none";

        }
    }
</script>