<?php

use yii\db\Migration;

/**
 * Class m210721_095420_modify_users_table_unique
 */
class m210721_095420_modify_users_table_unique extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('users', 'login', $this->string()->unique());
        $this->alterColumn('users', 'email', $this->string()->unique());
        $this->alterColumn('users', 'phone', $this->bigInteger()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('users', 'login', $this->string());
        $this->alterColumn('users', 'email', $this->string());
        $this->alterColumn('users', 'phone', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210721_095420_modify_users_table_unique cannot be reverted.\n";

        return false;
    }
    */
}
