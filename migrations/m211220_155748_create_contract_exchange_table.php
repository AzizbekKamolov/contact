<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contract_exchange}}`.
 */
class m211220_155748_create_contract_exchange_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contract_exchange}}', [
            'id'            => $this->primaryKey(),
            'con_exe_id'   => $this->integer(),
            'exe_user_id'   => $this->integer(),
            'rec_user_id'   => $this->integer(),
            'info'          => $this->text()->null(),
            'file'      => $this->string(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contract_exchange}}');
    }
}
