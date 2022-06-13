<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m211225_163203_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id'            => $this->primaryKey(),
            'name'          =>  $this->string(),
            'short_name'    => $this->string(),
            'code'          => $this->integer(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
