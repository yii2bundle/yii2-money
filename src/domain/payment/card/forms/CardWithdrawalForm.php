<?php

namespace yii2bundle\money\domain\payment\card\forms;

use yii\base\Model;

class CardWithdrawalForm extends Model {

    public $number;
    public $amount;

	public function rules()
    {
        return [
            [['number', 'amount'], 'trim'],
            [['number', 'amount'], 'required'],
            [['amount'], 'double'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'number' => 'Номер карты',
            'amount' => 'Сумма',
        ];
    }
}
