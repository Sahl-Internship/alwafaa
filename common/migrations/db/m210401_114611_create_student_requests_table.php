<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%join_requests}}`.
 */
class m210401_114611_create_student_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%join_courses}}','id');

        $this->createTable('{{%student_requests}}', [
            'id' => $this->primaryKey(),
            'course_id'=>$this->Integer(),
            'firstname'=>$this->string(),
            'lastname'=>$this->string(),
            'email'=>$this->string(),
            'sub_title'=>$this->string(),
            'country'=>$this->string(),
            'gender'=>$this->tinyInteger(),
            'phone_key'=>$this->string(),
            'phone'=>$this->string(),
            'status'=>$this->tinyInteger(),
            'is_parent'=>$this->tinyInteger(),
            'created_by'=>$this->Integer(),

        ]);

        $this->createTable('{{%request_attachment}}', [
            'id' => $this->primaryKey(),
            'request_id'=>$this->integer(),
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
            'fk_request_attachment_request_id',
            '{{%request_attachment}}',
            'request_id',
            '{{%student_requests}}',
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
        $this->dropForeignKey('fk_request_attachment_request_id', '{{%request_attachment}}');
        $this->dropTable('{{%request_attachment}}');
        $this->dropTable('{{%student_requests}}');
        $this->addColumn('{{%join_courses}}','id',$this->primaryKey());
    }
}
