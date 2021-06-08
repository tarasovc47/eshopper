<?php

use yii\db\Migration;

/**
 * Class m210608_164117_add_image_to_product
 */
class m210608_164117_add_image_to_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_164117_add_image_to_product cannot be reverted.\n";

        return false;
    }
    */
}
