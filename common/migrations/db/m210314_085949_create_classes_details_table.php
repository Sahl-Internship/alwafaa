<?php

use yii\db\Migration;

/**
 * Class m210314_085949_add_created_at_and_ubdated_at_to_course_table
 */
class m210314_085949_create_classes_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%class_details}}',[
           'id'=> $this->primaryKey(),
            'course_id'=>$this->integer(),
            'date'=>$this->integer(),
            'name'=>$this->string(),
        ]);

        $this->addForeignKey(
            'fk_class_details_course_id',
            '{{%class_details}}',
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
        $this->dropForeignKey('fk_class_details_course_id','{{%class_details}}');
        $this->dropTable('{{%class_details}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210314_085949_add_created_at_and_ubdated_at_to_course_table cannot be reverted.\n";

        return false;
    }
    */
}
