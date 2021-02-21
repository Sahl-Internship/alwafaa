<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course}}`.
 */
class m210221_080859_create_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'time' => $this->integer(),
            'duration' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->string(),
            'section_id' => $this->integer(),
            'teacher_id' => $this->integer(),
            'zoom_link' => $this->string(),
        ]);
        $this->addForeignKey(
            'fk_section_id_section',
            '{{%course}}',
            'section_id',
            '{{%section}}',
            'id',
            'cascade',
            'cascade'
        );
        $this->addForeignKey(
            'fk_teacher_id_user',
            '{{%course}}',
            'teacher_id',
            '{{%user}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_teacher_id_user', '{{%course}}');
        $this->dropForeignKey('fk_section_id_section', '{{%course}}');
        $this->dropTable('{{%course}}');
    }
}
