<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section}}`.
 */
class m210210_165839_create_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'description'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%section}}');
    }
}
