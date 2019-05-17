<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

/**
 * Class m190210_142003_create_money_transaction_table
 * 
 * @package 
 */
class m190210_142003_create_money_transaction_table extends Migration {

	public $table = '{{%money_transaction}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->primaryKey()->notNull()->comment('Идентификатор'),
			'amount' => $this->double()->notNull()->comment('Сумма'),
            'type' => $this->integer()->comment('Тип операции'),
			'sender_id' => $this->integer()->notNull()->comment('Отправитель'),
			'recipient_id' => $this->integer()->notNull()->comment('Получатель'),
            'status' => $this->integer()->notNull()->comment('Статус операции'),
			'description' => $this->string()->comment('Описание'),
            'data' => $this->text()->comment('Данные'),
			'donned_at' => $this->timestamp()->comment('Проведено'),
			'created_at' => $this->timestamp()->notNull()->comment('Создано'),
		];
	}

	public function afterCreate()
	{
        $this->myAddForeignKey(
            'sender_id',
            'user_person',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->myAddForeignKey(
            'recipient_id',
            'user_person',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

}