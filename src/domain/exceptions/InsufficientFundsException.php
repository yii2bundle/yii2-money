<?php

namespace yii2bundle\money\domain\exceptions;

use Throwable;
use yii\base\Exception;

class InsufficientFundsException extends Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if(empty($message)) {
            $message = \Yii::t('money/transaction', 'insufficient_funds');
        }
        parent::__construct($message, $code, $previous);
    }

    public function getName() {
		return 'InsufficientFundsException';
	}
}
