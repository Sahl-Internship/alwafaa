<?php

use yii\db\Migration;

/**
 * Class m210307_113929_edit_user_profile_table
 */
class m210307_113929_edit_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_profile}}','phone_key',$this->string()->after('lastname'));
        $this->addColumn('{{%user_profile}}','bio',$this->string());
        $this->addColumn('{{%user_profile}}','cover_path',$this->string());
        $this->addColumn('{{%user_profile}}','cover_base_url',$this->string());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_profile}}','phone_key');
        $this->dropColumn('{{%user_profile}}','bio');
        $this->dropColumn('{{%user_profile}}','cover_path');
        $this->dropColumn('{{%user_profile}}','cover_base_url');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210307_113929_edit_user_profile_table cannot be reverted.\n";

        return false;
    }
    */
}
