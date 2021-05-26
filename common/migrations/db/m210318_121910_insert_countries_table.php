<?php

use yii\db\Migration;

/**
 * Class m210318_121910_insert_countries_table
 */
class m210318_121910_insert_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = file_get_contents(__DIR__ .'/sql/Countries.sql');
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210318_121910_insert_countries_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210318_121910_insert_countries_table cannot be reverted.\n";

        return false;
    }
    */
}
