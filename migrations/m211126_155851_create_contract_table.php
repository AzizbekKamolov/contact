<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contract}}`.
 */
class m211126_155851_create_contract_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contract}}', [
            'id' =>         $this->primaryKey(),
            'project_id'    => $this->integer(),
            'title'         => $this->string(),
            'description'   => $this->text(),
            'price'         =>  $this->float(),
            'user_id'       => $this->integer(),
            'file_url'      => $this->string(),
            'status_id'     => $this->tinyInteger()->defaultValue(1),
            'deadline'      => $this->dateTime(),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contract}}');
    }
}
