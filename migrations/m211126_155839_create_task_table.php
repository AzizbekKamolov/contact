<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m211126_155839_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id'            => $this->primaryKey(),
            'project_id'    => $this->integer(),
            'title'         => $this->text(),
            'price'         => $this->float()->defaultValue(null),
            'currency_id'   => $this->integer(),
            'deadline'      => $this->dateTime(),
            'user_id'       => $this->integer(),
            'status_id'     => $this->tinyInteger()->defaultValue(1),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
