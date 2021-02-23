<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course_attachment}}`.
 */
class m210221_100910_create_course_attachment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course_attachment}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer(),
            'path' => $this->string(),
            'base_url' => $this->string(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_course_attachment_course_id',
            '{{%course_attachment}}',
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
        $this->dropForeignKey('fk_course_attachment_course_id','{{%course_attachment}}');
        $this->dropTable('{{%course_attachment}}');
    }
}
