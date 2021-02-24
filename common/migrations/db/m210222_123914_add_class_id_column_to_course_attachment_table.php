<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%course_attachment}}`.
 */
class m210222_123914_add_class_id_column_to_course_attachment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%course_attachment}}','class_id',$this->integer()->after('course_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%course_attachment}}','class_id');
    }
}
