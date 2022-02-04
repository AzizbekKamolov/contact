<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contracts}}`.
 */
class m220202_112555_add_currency_id_column_to_contracts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('contract', 'currency_id', $this->integer()->after('price'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('contract', 'currency_id');
    }
}
