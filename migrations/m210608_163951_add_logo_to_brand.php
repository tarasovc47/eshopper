<?php

use yii\db\Migration;

/**
 * Class m210608_163951_add_logo_to_brand
 */
class m210608_163951_add_logo_to_brand extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('brands', 'logo', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('brands', 'logo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_163951_add_logo_to_brand cannot be reverted.\n";

        return false;
    }
    */
}
