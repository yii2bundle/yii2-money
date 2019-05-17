<?php

namespace yii2bundle\money\domain\enums;

use yii2rails\extension\enum\base\BaseEnum;

class OperationTypeEnum extends BaseEnum {

    const EMIT = 100;
	const TRANSACTION = 200;
    const WITHDRAWAL = 300;

}
