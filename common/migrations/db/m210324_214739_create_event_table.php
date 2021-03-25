<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m210324_214739_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'course_id'=>$this->integer(),
            'date'=>$this->integer(),
            'day_id'=>$this->integer(),
            'from'=>$this->integer(),
            'to'=>$this->integer(),

        ]);
        $this->createTable('{{%event_attachment}}', [
            'id' => $this->primaryKey(),
            'event_id'=>$this->integer(),
            'path'=>$this->string(),
            'base_url'=>$this->string(),
            'type'=>$this->string(),
            'size'=>$this->integer(),
            'name'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'created_by'=>$this->integer(),
        ]);
        $this->addForeignKey(
            'fk_event_course_id',
            '{{%event}}',
            'course_id',
            '{{%course}}',
            'id',
            'cascade',
            'cascade'
        );
        $this->addForeignKey(
            'fk_event_attachment_event_id',
            '{{%event_attachment}}',
            'event_id',
            '{{%event}}',
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
        $this->dropForeignKey('fk_event_attachment_event_id','{{%event_attachment}}');
        $this->dropForeignKey('fk_event_course_id','{{%event}}');
        $this->dropTable('{{%event_attachment}}');
        $this->dropTable('{{%event}}');
    }
}
