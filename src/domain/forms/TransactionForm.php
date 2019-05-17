<?php

namespace yii2bundle\money\domain\forms;

use yii\base\Model;

class TransactionForm extends Model {

    public $sender_id;
    public $recipient_id;
    public $amount;
    public $description;

	public function rules()
    {
        return [
            [['sender_id', 'recipient_id', 'amount', 'description'], 'trim'],
            [['sender_id', 'recipient_id', 'amount'], 'required'],
            [['amount'], 'double'],
            ['description', 'string', 'min' => 3],
        ];
    }

}
