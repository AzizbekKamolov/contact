<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m211126_160029_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(),
            'type'      => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
