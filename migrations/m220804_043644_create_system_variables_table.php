<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%system_variables}}`.
 */
class m220804_043644_create_system_variables_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%system_variables}}', [
            'id'            => $this->primaryKey(),
            'key'           => $this->string(),
            'value'         =>  $this->string(),
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%system_variables}}');
    }
}
