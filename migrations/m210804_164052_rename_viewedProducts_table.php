<?php

use yii\db\Migration;

/**
 * Class m210804_164052_rename_viewedProducts_table
 */
class m210804_164052_rename_viewedProducts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('viewed_products', 'wish_list');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('wish_list', 'viewed_products');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210804_164052_rename_viewedProducts_table cannot be reverted.\n";

        return false;
    }
    */
}
