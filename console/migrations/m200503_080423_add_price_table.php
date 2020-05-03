<?php

use yii\db\Migration;

/**
 * Class m200503_080423_add_price_table
 */
class m200503_080423_add_price_table extends Migration
{
    const TABLE_PRICES = 'prices';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_PRICES, [
            'id' => $this->primaryKey(),
            'article' => $this->text()->null(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_PRICES);
    }

}
