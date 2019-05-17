<?php

namespace yii2bundle\money\domain\payment\wooppay\forms;

use yii\base\Model;

class WooppayWithdrawalForm extends Model {

    public $phone;
    public $amount;

	public function rules()
    {
        return [
            [['phone', 'amount'], 'trim'],
            [['phone', 'amount'], 'required'],
            [['amount'], 'double'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Номер телефона',
            'amount' => 'Сумма',
        ];
    }
}
