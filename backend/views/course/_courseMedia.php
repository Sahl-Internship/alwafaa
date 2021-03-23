<?php
/**
 * @var yii\web\View $this
 * @var common\models\Course $model
 * @var common\models\CourseAttachment $files
 * @var yii\bootstrap4\ActiveForm $form
 * @var common\models\Section $sectionList
 * @var common\models\User $teacherList
 */

use kartik\widgets\FileInput;
use trntv\filekit\widget\Upload;
use yii\helpers\Url;
use yii\web\JsExpression;

?>
<?php echo $form->field($model, 'image')->widget(
    Upload::class,
    [
        'url' => ['/file/storage/upload'],
        'maxFileSize' => 5000000, // 5 MiB,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]
) ?>


<?php echo $form->field($model, 'attachments')->widget(
    Upload::class,
    [
        'url' => ['/file/storage/upload'],
        'sortable' => true,
        'maxFileSize' => 10000000, // 10 MiB
        'maxNumberOfFiles' => 10,
//        'acceptFileTypes' => new JsExpression('(.*?)\.(docx|doc|pdf|xml|bmp|ppt|xls)$'),
    ]
) ?>

<!---->
<?php //echo $form->field($model, 'intro_video')->widget(
//    Upload::class,
//    [
//        'url' => ['/file/storage/upload'],
//        'maxFileSize' => 30*1024*1024, // 30 MiB,
//        'acceptFileTypes' => new JsExpression('/(\.|\/)(mp4|mkv)$/i'),
//    ]
//) ?>



