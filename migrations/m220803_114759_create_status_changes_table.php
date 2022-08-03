<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status_changes}}`.
 */
class m220803_114759_create_status_changes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status_changes}}', [
            'id'            => $this->primaryKey(),
            'object_type'   => $this->string(),
            'object_id'     => $this->integer(),
            'status_id'     => $this->integer(),
            'comment'       => $this->text(),
            'user_id'       => $this->integer(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status_changes}}');
    }
}
