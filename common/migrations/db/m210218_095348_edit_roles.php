<?php

use yii\db\Migration;

/**
 * Class m210218_095348_edit_roles
 */
class m210218_095348_edit_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = file_get_contents(__DIR__ .'/sql/StRoles.sql');
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210218_095348_edit_roles cannot be reverted.\n";

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
