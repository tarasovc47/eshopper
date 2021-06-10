<?php

use yii\db\Migration;

/**
 * Class m210610_170701_rename_Products_column
 */
class m210610_170701_rename_Products_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('products', 'category', 'category_id');
        $this->renameColumn('products', 'brand', 'brand_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210610_170701_rename_Products_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210610_170701_rename_Products_column cannot be reverted.\n";

        return false;
    }
    */
}
