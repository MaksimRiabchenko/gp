<?php

use yii\db\Migration;

/**
 * Class m200503_094741_prices_user_id
 */
class m200503_094741_prices_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prices', 'user_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('prices', 'user_id');
    }
}
