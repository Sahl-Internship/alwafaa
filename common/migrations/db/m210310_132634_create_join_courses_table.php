<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%join_courses}}`.
 */
class m210310_132634_create_join_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%join_courses}}', [
            'id' => $this->primaryKey(),
            'course_id'=>$this->integer(),
            'user_id'=>$this->integer(),
        ]);

        $this->addForeignKey('fk_join_courses_course_id', '{{%join_courses}}', 'course_id', '{{%course}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_join_courses_user_id', '{{%join_courses}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_join_courses_course_id', '{{%join_courses}}');
        $this->dropForeignKey('fk_join_courses_user_id', '{{%join_courses}}');
        $this->dropTable('{{%join_courses}}');
    }
}
