<?php

use yii\db\Migration;

/**
 * Class m210611_170651_rename_Brand_column
 */
class m210611_170651_rename_Brand_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('brands', 'logo', 'image');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210611_170651_rename_Brand_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210611_170651_rename_Brand_column cannot be reverted.\n";

        return false;
    }
    */
}
