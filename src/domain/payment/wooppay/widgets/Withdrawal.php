<?php

namespace yii2bundle\money\domain\payment\wooppay\widgets;

use yii2bundle\money\domain\payment\wooppay\forms\WooppayWithdrawalForm;
use yii\base\Widget;
use yii2rails\domain\helpers\Helper;

class Withdrawal extends Widget
{

	public function run() {
        $model = new WooppayWithdrawalForm;
        if(\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post($model->formName());
            if(!empty($post)) {
                Helper::forgeForm($model);
                $model->validate();
            }
        }
        echo $this->render('main.php', [
            'model' => $model,
        ]);
	}

}
