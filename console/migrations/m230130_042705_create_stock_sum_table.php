<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stock_sum}}`.
 */
class m230130_042705_create_stock_sum_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stock_sum}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'warehouse_id' => $this->integer(),
            'lot_no' => $this->string(),
            'expired_date' => $this->datetime(),
            'qty' => $this->float(),
            'trans_ref_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stock_sum}}');
    }
}
