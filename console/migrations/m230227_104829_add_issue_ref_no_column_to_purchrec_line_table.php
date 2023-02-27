<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%purchrec_line}}`.
 */
class m230227_104829_add_issue_ref_no_column_to_purchrec_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%purchrec_line}}', 'issue_ref_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%purchrec_line}}', 'issue_ref_no');
    }
}
