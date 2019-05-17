<?php

namespace yii2bundle\money\domain\interfaces\services;

use yii2rails\domain\interfaces\services\CrudInterface;

/**
 * Interface TransactionInterface
 * 
 * @package yii2bundle\money\domain\interfaces\services
 * 
 * @property-read \yii2bundle\money\domain\Domain $domain
 * @property-read \yii2bundle\money\domain\interfaces\repositories\TransactionInterface $repository
 */
interface TransactionInterface extends CrudInterface {

}
