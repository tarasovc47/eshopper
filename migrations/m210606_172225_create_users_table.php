<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210606_172225_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'gender' => $this->string()->notNull(),
            'login' => $this->integer(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'phone' => $this->integer()->notNull(),
            'confirm' => $this->boolean()->defaultValue(false),
            'isAdmin' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
