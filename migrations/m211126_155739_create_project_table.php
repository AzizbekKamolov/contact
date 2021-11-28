<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m211126_155739_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string(),
            'description'   => $this->text()->defaultValue(null),
            'budget_sum'    => $this->float()->defaultValue(null),
            'project_year'  => $this->date()->defaultValue(null),
            'user_id'       => $this->integer()->defaultValue(null),
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
        $this->dropTable('{{%project}}');
    }
}
