<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stock_trans}}`.
 */
class m230131_110651_create_stock_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stock_trans}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'trans_module_type_id' => $this->integer(),
            'activity_type_id' => $this->integer(),
            'item_id' => $this->integer(),
            'lot_no' => $this->string(),
            'exp_date' => $this->datetime(),
            'qty' => $this->float(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stock_trans}}');
    }
}
