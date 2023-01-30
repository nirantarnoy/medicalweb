<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchrec_line}}`.
 */
class m230130_111959_create_purchrec_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purchrec_line}}', [
            'id' => $this->primaryKey(),
            'purchrec_id' => $this->integer(),
            'item_id' => $this->integer(),
            'lot_no' => $this->string(),
            'exp_date' => $this->datetime(),
            'qty' => $this->float(),
            'unit_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%purchrec_line}}');
    }
}
