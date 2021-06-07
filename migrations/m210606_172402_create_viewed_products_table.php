<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%viewed_products}}`.
 */
class m210606_172402_create_viewed_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%viewed_products}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%viewed_products}}');
    }
}
