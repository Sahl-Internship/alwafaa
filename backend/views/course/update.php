<?php

/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 * @var common\models\CourseAttachment $files
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */

$this->title = Yii::t('backend','Update Course').': ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => ' / '.Yii::t('backend','Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','Update');
?>
<div class="course-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'files' => $files,
        'sectionList'=>$sectionList,
        'teacherList'=>$teacherList,
//        'course_time'=>$course_time,
    ]) ?>

</div>
