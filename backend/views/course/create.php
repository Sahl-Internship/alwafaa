<?php

/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 * @var common\models\CourseAttachment $files
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */

$this->title = Yii::t('backend','Create Course');
$this->params['breadcrumbs'][] = ['label' => ' / '.Yii::t('backend','Courses'),
    'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'files' => $files,
        'sectionList'=>$sectionList,
        'teacherList'=>$teacherList,
    ]) ?>

</div>
