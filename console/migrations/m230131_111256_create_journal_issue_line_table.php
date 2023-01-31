<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%journal_issue_line}}`.
 */
class m230131_111256_create_journal_issue_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%journal_issue_line}}', [
            'id' => $this->primaryKey(),
            'issue_id' => $this->integer(),
            'item_id' => $this->integer(),
            'lot_no' => $this->string(),
            'exp_date' => $this->datetime(),
            'qty' => $this->float(),
            'status' => $this->integer(),
            'note' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%journal_issue_line}}');
    }
}
