<?php

namespace yii2bundle\money\domain\services;

use yii2bundle\money\domain\enums\OperationTypeEnum;
use yii2bundle\money\domain\entities\TransactionEntity;
use yii2bundle\money\domain\exceptions\InsufficientFundsException;
use yii2bundle\money\domain\forms\TransactionForm;
use yii2bundle\money\domain\interfaces\services\TransactionInterface;
use yii\web\NotFoundHttpException;
use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use yii2rails\domain\services\base\BaseActiveService;
use yii2rails\extension\common\enums\StatusEnum;

/**
 * Class TransactionService
 * 
 * @package yii2bundle\money\domain\services
 * 
 * @property-read \yii2bundle\money\domain\Domain $domain
 * @property-read \yii2bundle\money\domain\interfaces\repositories\TransactionInterface $repository
 */
class TransactionService extends BaseActiveService implements TransactionInterface {

    public $issuerPersonIds;

    public function balance($personId) {
        $receivedCollection = $this->repository->allReceivedByPersonId($personId);
        $sentCollection = $this->repository->allSentByPersonId($personId);
        $receivedAmount = $this->getSum($receivedCollection);
        $sentAmount = $this->getSum($sentCollection);
        $balance = $receivedAmount - $sentAmount;
        return floatval($balance);
    }

    public function emit(TransactionForm $model) {
        $model->sender_id = 235;
        if(!in_array($model->sender_id, $this->issuerPersonIds)) {
            throw new NotFoundHttpException(\Yii::t('money/transaction', 'sender_not_issuer'));
        }
        $model->validate();
        if($model->hasErrors()) {
            throw new UnprocessableEntityHttpException($model);
        }
        $this->create([
            'amount' => $model->amount,
            'type' => OperationTypeEnum::EMIT,
            'status' => StatusEnum::ENABLE,
            'sender_id' => $model->sender_id,
            'recipient_id' => $model->recipient_id,
            'description' => $model->description,
        ]);
    }

    public function send(TransactionForm $model) {
        $model->validate();
        if($model->hasErrors()) {
            throw new UnprocessableEntityHttpException($model);
        }
        $this->checkSenderBalance($model);
        // заморозить часть средств
        $this->create([
            'amount' => $model->amount,
            'type' => OperationTypeEnum::TRANSACTION,
            'status' => StatusEnum::ENABLE,
            'sender_id' => $model->sender_id,
            'recipient_id' => $model->recipient_id,
            'description' => $model->description,
            'data' => '11',
        ]);
        // обновить кэш баланса
    }

    public function checkSenderBalance(TransactionForm $model) {
        // узнать остаток баланса отправителя
        $senderBalance = $this->balance($model->sender_id);
        if($senderBalance < $model->amount) {
            throw new InsufficientFundsException();
        }
    }

    private function getSum($collection) {
        $amount = 0;
        /** @var TransactionEntity[] $collection */
        foreach ($collection as $item) {
            $amount += $item->amount;
        }
        return $amount;
    }

}
