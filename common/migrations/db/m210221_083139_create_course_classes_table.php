<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course_classes}}`.
 */
class m210221_083139_create_course_classes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course_classes}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer(),
            'title' => $this->string(),
            'time' => $this->integer(),
            'duration' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk_course_id_course',
            '{{%course_classes}}',
            'course_id',
            '{{%course}}',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_course_id_course','{{%course_classes}}');
        $this->dropTable('{{%course_classes}}');
    }
}
