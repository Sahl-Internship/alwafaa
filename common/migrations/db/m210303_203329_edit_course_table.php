<?php

use yii\db\Migration;

/**
 * Class m210303_203329_edit_course_table
 */
class m210303_203329_edit_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%course}}','time');
        $this->dropColumn('{{%course}}','duration');

        $this->dropColumn('{{%course_classes}}','title');
        $this->dropColumn('{{%course_classes}}','time');
        $this->dropColumn('{{%course_classes}}','duration');

        $this->addColumn('{{%course}}','sub_title',$this->string(255)->after('title'));
        $this->addColumn('{{%course}}','requirement',$this->string(1024));
        $this->addColumn('{{%course}}','target_student',$this->string(1024));
        $this->addColumn('{{%course}}','targeted_skills',$this->string(1024));
        $this->addColumn('{{%course}}','intro_base_url',$this->string(1024));
        $this->addColumn('{{%course}}','intro_path',$this->string(1024));
        $this->addColumn('{{%course}}','start_at',$this->string(1024)->after('zoom_link'));
        $this->addColumn('{{%course}}','end_at',$this->string(1024)->after('start_at'));

        $this->addColumn('{{%course_classes}}','day_id',$this->string(1024));
        $this->addColumn('{{%course_classes}}','from',$this->string(1024));
        $this->addColumn('{{%course_classes}}','to',$this->string(1024));


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%course}}','sub_title');
        $this->dropColumn('{{%course}}','requirement');
        $this->dropColumn('{{%course}}','target_student');
        $this->dropColumn('{{%course}}','targeted_skills');
        $this->dropColumn('{{%course}}','intro_base_url');
        $this->dropColumn('{{%course}}','intro_path');
        $this->dropColumn('{{%course}}','start_at');
        $this->dropColumn('{{%course}}','end_at');

        $this->dropColumn('{{%course_classes}}','day_id');
        $this->dropColumn('{{%course_classes}}','from');
        $this->dropColumn('{{%course_classes}}','to');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210303_203329_edit_course_table cannot be reverted.\n";

        return false;
    }
    */
}
