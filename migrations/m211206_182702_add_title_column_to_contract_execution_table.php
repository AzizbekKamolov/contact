<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contract_execution}}`.
 */
class m211206_182702_add_title_column_to_contract_execution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('contract_execution', 'title', $this->string()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('contract_execution', 'title');
    }
}
