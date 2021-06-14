<?php

use yii\db\Migration;

/**
 * Class m210614_073932_modify_User_column
 */
class m210614_073932_modify_User_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('Users', 'login','string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210614_073932_modify_User_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210614_073932_modify_User_column cannot be reverted.\n";

        return false;
    }
    */
}
