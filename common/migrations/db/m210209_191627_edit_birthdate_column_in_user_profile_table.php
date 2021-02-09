<?php

use yii\db\Migration;

/**
 * Class m210209_191627_edit_birthdate_column_in_user_profile_table
 */
class m210209_191627_edit_birthdate_column_in_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user_profile}}', 'birthday');
        $this->addColumn('{{%user_profile}}', 'birthdate', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_profile}}', 'birthdate');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210209_191627_edit_birthdate_column_in_user_profile_table cannot be reverted.\n";

        return false;
    }
    */
}
