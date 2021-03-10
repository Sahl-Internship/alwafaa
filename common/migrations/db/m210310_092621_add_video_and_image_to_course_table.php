<?php

use yii\db\Migration;

/**
 * Class m210310_092621_add_video_and_image_to_course_table
 */
class m210310_092621_add_video_and_image_to_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_course_media_course_id','{{%course_media}}');
        $this->dropTable('{{%course_media}}');

        $this->addColumn('{{%course}}','image_path',$this->string());
        $this->addColumn('{{%course}}','image_base_url',$this->string());

        $this->addColumn('{{%course}}','intro_path',$this->string());
        $this->addColumn('{{%course}}','intro_base_url',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%course}}','image_path');
        $this->dropColumn('{{%course}}','image_base_url');
        $this->dropColumn('{{%course}}','intro_base_url');
        $this->dropColumn('{{%course}}','intro_path');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210310_092621_add_video_and_image_to_course_table cannot be reverted.\n";

        return false;
    }
    */
}
