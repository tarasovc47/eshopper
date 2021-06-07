<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m210606_172255_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string()->notNull(),
            'date' => $this->date()->notNull(),
            'user' => $this->integer()->notNull(),
            'confirm' => $this->boolean()->defaultValue(false),
            'status' => $this->string()->defaultValue('new')
        ]);
        $this->createIndex(
            'idx-order-user_id',
            'orders',
            'user'
        );
        $this->addForeignKey(
            'fk-order-user_id',
            'orders',
            'user',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
