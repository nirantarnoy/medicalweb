<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medical}}`.
 */
class m230130_041541_create_medical_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medical}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
            'medical_cat_id' => $this->integer(),
            'pack_size' => $this->integer(),
            'unit_id' => $this->integer(),
            'price' => $this->float(),
            'min_stock' => $this->float(),
            'max_stock' => $this->float(),
            'photo' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%medical}}');
    }
}
