<?php

use yii\db\Migration;

/**
 * Class m210318_130551_edit_text_areas_length
 */
class m210318_130551_edit_text_areas_length extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%course}}', 'description', $this->text());
        $this->alterColumn('{{%course}}', 'requirement', $this->text());
        $this->alterColumn('{{%course}}', 'target_student', $this->text());
        $this->alterColumn('{{%course}}', 'targeted_skills', $this->text());
        $this->alterColumn('{{%user_profile}}', 'bio', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user_profile}}', 'bio', $this->string());
        $this->alterColumn('{{%course}}', 'targeted_skills', $this->string());
        $this->alterColumn('{{%course}}', 'target_student', $this->string());
        $this->alterColumn('{{%course}}', 'requirement', $this->string());
        $this->alterColumn('{{%course}}', 'description', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210318_130551_edit_text_areas_length cannot be reverted.\n";

        return false;
    }
    */
}
