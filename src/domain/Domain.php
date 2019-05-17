<?php

namespace yii2bundle\money\domain;

use yii2rails\domain\enums\Driver;

/**
 * Class Domain
 * 
 * @property-read \yii2bundle\money\domain\interfaces\services\TransactionInterface $transaction
 * @property-read \yii2bundle\money\domain\interfaces\repositories\RepositoriesInterface $repositories
 */
class Domain extends \yii2rails\domain\Domain {
	
	public function config() {
		return [
			'repositories' => [
                'transaction' => Driver::ACTIVE_RECORD,
			],
			'services' => [
                'transaction',
			],
		];
	}
	
}