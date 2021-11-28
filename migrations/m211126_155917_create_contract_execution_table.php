<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contract_execution}}`.
 */
class m211126_155917_create_contract_execution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contract_execution}}', [
            'id'            => $this->primaryKey(),
            'contract_id'   => $this->integer(),
            'user_id'       => $this->integer(),
            'exe_user_id'   => $this->integer(),
            'status_id'     => $this->tinyInteger()->defaultValue(1),
            'info'          => $this->text(),
            'done_date'     => $this->dateTime(),
            'mark'          => $this->tinyInteger(),
            'receive_date'  => $this->dateTime(),
            'receive_user'  => $this->integer(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contract_execution}}');
    }
}
