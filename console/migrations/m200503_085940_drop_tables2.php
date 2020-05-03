<?php

use yii\db\Migration;

/**
 * Class m200503_085940_drop_tables2
 */
class m200503_085940_drop_tables2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%categories}}');
        $this->dropTable('{{%item_options}}');
        $this->dropTable('{{%item_option_categories}}');
        $this->dropTable('{{%item_option_values}}');
        $this->dropTable('{{%measures}}');
        $this->dropTable('{{%social_account}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200503_085940_drop_tables2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_085940_drop_tables2 cannot be reverted.\n";

        return false;
    }
    */
}
