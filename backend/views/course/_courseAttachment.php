<?php
/**
* @var yii\web\View $this
* @var common\models\Course $model
* @var yii\bootstrap4\ActiveForm $form
* @var common\models\Section $sectionList
* @var common\models\User $teacherList
*/

use trntv\filekit\widget\Upload;

?>

<?php echo $form->field($model, 'attachments')->widget(
    Upload::class,
    [
        'url' => ['/file/storage/upload'],
        'sortable' => true,
        'maxFileSize' => 10000000, // 10 MiB
        'maxNumberOfFiles' => 10,
    ]
)->label(Yii::t('backend','Attachment')) ?>




