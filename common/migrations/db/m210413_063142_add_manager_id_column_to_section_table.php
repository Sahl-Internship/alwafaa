<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%section}}`.
 */
class m210413_063142_add_manager_id_column_to_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%section}}','is_deleted',$this->integer());
        $this->addColumn('{{%section}}','manager_id',$this->integer());
        $this->addForeignKey(
            'fk_section_manager_id',
            '{{%section}}',
            'manager_id',
            '{{%user}}',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_section_manager_id', '{{%section}}');
        $this->dropColumn('{{%section}}','manager_id');
        $this->dropColumn('{{%section}}','is_deleted');
    }
}
