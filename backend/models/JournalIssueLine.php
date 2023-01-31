<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "journal_issue_line".
 *
 * @property int $id
 * @property int|null $issue_id
 * @property int|null $item_id
 * @property string|null $lot_no
 * @property string|null $exp_date
 * @property float|null $qty
 * @property int|null $status
 * @property string|null $note
 */
class JournalIssueLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_issue_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['issue_id', 'item_id', 'status'], 'integer'],
            [['exp_date'], 'safe'],
            [['qty'], 'number'],
            [['lot_no', 'note'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'issue_id' => 'Issue ID',
            'item_id' => 'Item ID',
            'lot_no' => 'Lot No',
            'exp_date' => 'Exp Date',
            'qty' => 'Qty',
            'status' => 'Status',
            'note' => 'Note',
        ];
    }
}
