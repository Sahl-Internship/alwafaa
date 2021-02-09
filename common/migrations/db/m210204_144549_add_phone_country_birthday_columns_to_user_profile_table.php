<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_profile}}`.
 */
class m210204_144549_add_phone_country_birthday_columns_to_user_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_profile}}','phone',$this->string()->after('lastname'));
        $this->addColumn('{{%user_profile}}','country',$this->string());
        $this->addColumn('{{%user_profile}}','birthday',$this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_profile}}', 'phone');
        $this->dropColumn('{{%user_profile}}', 'country');
        $this->dropColumn('{{%user_profile}}', 'birthday');
    }
}
