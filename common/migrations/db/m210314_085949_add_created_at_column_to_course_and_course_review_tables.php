<?php

use yii\db\Migration;

/**
 * Class m210314_085949_add_created_at_and_ubdated_at_to_course_table
 */
class m210314_085949_add_created_at_column_to_course_and_course_review_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%course}}','created_at',$this->integer());
        $this->addColumn('{{%course_review}}','created_at',$this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%course}}','created_at');
        $this->dropColumn('{{%course_review}}','created_at');


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
