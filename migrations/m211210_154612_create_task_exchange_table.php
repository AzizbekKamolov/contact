<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_exchange}}`.
 */
class m211210_154612_create_task_exchange_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_exchange}}', [
            'id'            => $this->primaryKey(),
            'task_exe_id'   => $this->integer(),
            'exe_user_id'   => $this->integer(),
            'rec_user_id'   => $this->integer(),
            'info'          => $this->text()->null(),
            'file'          => $this->string(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_exchange}}');
    }
}
