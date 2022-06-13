<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expense}}`.
 */
class m220609_065158_create_expense_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%expense}}', [
            'id'            => $this->primaryKey(),
            'user_id'       => $this->integer(),
            'project_id'    => $this->integer(),
            'contract_id'   => $this->integer(),
            'currency_id'   => $this->integer(),
            'sum'           => $this->float()->defaultValue(null),
            'rate'          => $this->float(),
            'desc'          => $this->string(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%expense}}');
    }
}
