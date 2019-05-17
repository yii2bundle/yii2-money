<?php

namespace yii2bundle\money\domain\repositories\ar;

use yii2bundle\money\domain\interfaces\repositories\TransactionInterface;
use yii2lab\db\domain\helpers\TableHelper;
use yii2rails\domain\data\Query;
use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2rails\extension\common\enums\StatusEnum;

/**
 * Class TransactionRepository
 * 
 * @package yii2bundle\money\domain\repositories\ar
 * 
 * @property-read \yii2bundle\money\domain\Domain $domain
 */
class TransactionRepository extends BaseActiveArRepository implements TransactionInterface {

	protected $schemaClass = true;

    public function tableName()
    {
        return TableHelper::getGlobalName('money_transaction');
    }

    public function allSentByPersonId($personId, Query $query = null) {
        $query = Query::forge($query);
        $query->andWhere(['status' => StatusEnum::ENABLE]);
        $query->andWhere(['sender_id' => $personId]);
        return $this->all($query);
    }

    public function allReceivedByPersonId($personId, Query $query = null) {
        $query = Query::forge($query);
        $query->andWhere(['status' => StatusEnum::ENABLE]);
        $query->andWhere(['recipient_id' => $personId]);
        return $this->all($query);
    }

}
