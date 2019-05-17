<?php

namespace yii2bundle\money\domain\entities;

use yii2bundle\money\domain\enums\OperationTypeEnum;
use yii2rails\domain\BaseEntity;
use yii2rails\domain\values\TimeValue;

/**
 * Class TransactionEntity
 * 
 * @package yii2bundle\money\domain\entities
 * 
 * @property $id
 * @property $amount
 * @property $type
 * @property $status
 * @property $sender_id
 * @property $recipient_id
 * @property $description
 * @property $data
 * @property $donned_at
 * @property $created_at
 */
class TransactionEntity extends BaseEntity {

	protected $id;
	protected $amount;
    protected $type;
    protected $status;
	protected $sender_id;
	protected $recipient_id;
	protected $description;
    protected $data = [];
	protected $donned_at;
	protected $created_at;

    public function init() {
        parent::init();
        $this->created_at = new TimeValue;
        $this->created_at->setNow();
    }

	public function rules() {
        return [
            [['sender_id', 'recipient_id', 'amount', 'description'], 'trim'],
            [['sender_id', 'recipient_id', 'amount'], 'required'],
            [['amount'], 'double'],
            ['type', 'in', 'range' => OperationTypeEnum::values()],
            ['description', 'string', 'min' => 3],
        ];
    }

}
