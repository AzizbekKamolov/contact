<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_execution}}`.
 */
class m211126_160007_create_task_execution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_execution}}', [
            'id'            => $this->primaryKey(),
            'task_id'       => $this->integer(),
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
        $this->dropTable('{{%task_execution}}');
    }
}
