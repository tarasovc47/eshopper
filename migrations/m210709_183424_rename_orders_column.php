<?php

use yii\db\Migration;

/**
 * Class m210709_183424_rename_orders_column
 */
class m210709_183424_rename_orders_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('orders', 'user', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210709_183424_rename_orders_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210709_183424_rename_orders_column cannot be reverted.\n";

        return false;
    }
    */
}
