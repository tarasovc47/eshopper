<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m210606_172211_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'cost' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'gender' => $this->string()->notNull(),
            'brand' => $this->string()->defaultValue('бренд не указан'),
            'category' => $this->string()->defaultValue('категория не указана'),
            'hidden' => $this->boolean()->defaultValue(true),
            'new' => $this->boolean()->defaultValue(true),
            'sale' => $this->boolean()->defaultValue(false),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
