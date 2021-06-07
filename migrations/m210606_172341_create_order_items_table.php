<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m210606_172341_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'product_count' => $this->integer()->notNull(),
            'product_price' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-items-product_id',
            'order_items',
            'product_id'
        );
        $this->createIndex(
            'idx-items-order_id',
            'order_items',
            'order_id'
        );
        $this->addForeignKey(
            'fk-order_items-order_id',
            'order_items',
            'order_id',
            'orders',
            'id'
        );
        $this->addForeignKey(
            'fk-order_items-product_id',
            'order_items',
            'product_id',
            'products',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_items}}');
    }
}
