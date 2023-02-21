<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%purchrec}}`.
 */
class m230213_143325_add_note_column_to_purchrec_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%purchrec}}', 'note', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%purchrec}}', 'note');
    }
}
