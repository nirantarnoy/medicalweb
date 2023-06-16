<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%medical}}`.
 */
class m230314_065349_add_pack_size_desc_column_to_medical_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%medical}}', 'pack_size_desc', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%medical}}', 'pack_size_desc');
    }
}
