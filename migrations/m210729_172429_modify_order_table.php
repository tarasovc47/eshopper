<?php

use yii\db\Migration;

/**
 * Class m210729_172429_modify_order_table
 */
class m210729_172429_modify_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('orders', 'status', 'status_id');
        $this->alterColumn('orders', 'status_id', $this->integer()->defaultValue(1));
        $this->createIndex(
            'idx-order_status_id',
            'orders',
            'status_id'
        );
        $this->addForeignKey(
            'fk-order_status_id',
            'orders',
            'status_id',
            'order_statuses',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-order_status_id',
            'orders'
        );
        $this->dropIndex('idx-order_status_id', 'orders');
        $this->alterColumn('orders', 'status_id', $this->string());
        $this->renameColumn('orders', 'status_id', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210729_172429_modify_order_table cannot be reverted.\n";

        return false;
    }
    */
}
