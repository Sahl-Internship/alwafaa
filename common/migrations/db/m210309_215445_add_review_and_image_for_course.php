<?php

use yii\db\Migration;

/**
 * Class m210309_215445_add_review_and_image_for_course
 */
class m210309_215445_add_review_and_image_for_course extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn("{{%course}}","intro_path");
        $this->dropColumn("{{%course}}","intro_base_url");

        $this->createTable('{{%course_media}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer(),
            'image_path' => $this->string(),
            'image_base_url' => $this->string(),
            'intro_path' => $this->string(),
            'intro_base_url' => $this->string(),
        ]);
        $this->createTable('{{%course_review}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer(),
            'rate' => $this->float(),
            'review' => $this->string(),
            'created_by' => $this->integer(),
        ]);


        $this->addForeignKey('fk_course_media_course_id', '{{%course_media}}', 'course_id', '{{%course}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_course_review_course_id', '{{%course_review}}', 'course_id', '{{%course}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_course_review_user_id', '{{%course_review}}', 'created_by', '{{%user}}', 'id', 'cascade', 'cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_course_media_course_id','{{%course_media}}');
        $this->dropForeignKey('fk_course_review_course_id', '{{%course_review}}');
        $this->dropForeignKey('fk_course_review_user_id', '{{%course_review}}');

        $this->dropTable('{{%course_review}}');
        $this->dropTable('{{%course_media}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210309_215445_add_review_and_image_for_course cannot be reverted.\n";

        return false;
    }
    */
}
