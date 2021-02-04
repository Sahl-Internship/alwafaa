<?php

use yii\db\Migration;

/**
 * Class m210204_102044_editRoles
 */
class m210204_102044_editRoles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = file_get_contents(__DIR__ .'/sql/Roles.sql');
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210204_102044_editRoles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210204_102044_editRoles cannot be reverted.\n";

        return false;
    }
    */
}
