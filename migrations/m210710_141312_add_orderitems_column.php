<?php

use yii\db\Migration;

/**
 * Class m210710_141312_add_orderitems_column
 */
class m210710_141312_add_orderitems_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order_items', 'title', $this->string());
        $this->addColumn('order_items', 'order_sum', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order_items', 'title');
        $this->dropColumn('order_items', 'order_sum');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210710_141312_add_orderitems_column cannot be reverted.\n";

        return false;
    }
    */
}
