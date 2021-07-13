<?php

use yii\db\Migration;

/**
 * Class m210710_133603_add_orders_column
 */
class m210710_133603_add_orders_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('orders', 'quantity', $this->integer());
        $this->addColumn('orders', 'sum', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('orders', 'quantity');
        $this->dropColumn('orders', 'sum');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210710_133603_add_orders_column cannot be reverted.\n";

        return false;
    }
    */
}
