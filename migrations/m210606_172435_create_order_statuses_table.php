<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_statuses}}`.
 */
class m210606_172435_create_order_statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_statuses}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_statuses}}');
    }
}
