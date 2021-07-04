<?php

use yii\db\Migration;

/**
 * Class m210704_120218_add_detail_to_product
 */
class m210704_120218_add_detail_to_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'detail', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210704_120218_add_detail_to_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210704_120218_add_detail_to_product cannot be reverted.\n";

        return false;
    }
    */
}
