<?php

use yii\db\Migration;

/**
 * Class m210614_111703_modife_User_column
 */
class m210614_111703_modife_User_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('Users', 'phone','bigint');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210614_111703_modife_User_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210614_111703_modife_User_column cannot be reverted.\n";

        return false;
    }
    */
}
