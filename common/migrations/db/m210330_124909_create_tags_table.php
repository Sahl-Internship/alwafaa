<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tags}}`.
 */
class m210330_124909_create_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%course}}','updated_at',$this->integer());
        $this->createTable('{{%tags}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'slug'=>$this->string(),
        ]);

        $this->createTable('{{%tag_course}}', [
            'tag_id'=>$this->integer(),
            'course_id'=>$this->integer(),

        ]);

        $this->addForeignKey(
            'fk_tag_course_tag_id',
            '{{%tag_course}}',
            'tag_id',
            '{{%tags}}',
            'id',
            'cascade',
            'cascade'
        );
        $this->addForeignKey(
            'fk_tag_course_course_id',
            '{{%tag_course}}',
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
        $this->dropForeignKey('fk_tag_course_course_id', '{{%tag_course}}');
        $this->dropForeignKey('fk_tag_course_tag_id', '{{%tag_course}}');
        $this->dropTable('{{%tag_course}}');
        $this->dropTable('{{%tags}}');
        $this->dropColumn('{{%course}}','updated_at');

    }
}
