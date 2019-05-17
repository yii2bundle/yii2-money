<?php

namespace yii2bundle\money\domain\interfaces\repositories;

use yii2rails\domain\data\Query;
use yii2rails\domain\interfaces\repositories\CrudInterface;

/**
 * Interface TransactionInterface
 * 
 * @package yii2bundle\money\domain\interfaces\repositories
 * 
 * @property-read \yii2bundle\money\domain\Domain $domain
 */
interface TransactionInterface extends CrudInterface {

    public function allSentByPersonId($personId, Query $query = null);
    public function allReceivedByPersonId($personId, Query $query = null);

}
