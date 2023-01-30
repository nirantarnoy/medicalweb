<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medical_cat}}`.
 */
class m230130_041253_create_medical_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medical_cat}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
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
        $this->dropTable('{{%medical_cat}}');
    }
}
