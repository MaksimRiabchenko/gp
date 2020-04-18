<?php

use yii\db\Migration;

/**
 * Class m200418_160103_drop_tables
 */
class m200418_160103_drop_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $connection = Yii::$app->db;
        $this->dropTable('{{%order_payment}}');
        $this->dropTable('{{%order_field_value_variant}}');
        $this->dropTable('{{%order_field_value}}');
        $this->dropTable('{{%order_field}}');
        $this->dropTable('{{%order_element}}');
        $this->dropTable('{{%cart_element}}');
        $this->dropTable('{{%cart}}');
        $this->dropTable('{{%order_field_type}}');
        $this->dropForeignKey('fk_order_payment', '{{%order}}');
        $this->dropForeignKey('fk_order_shipping', '{{%order}}');
        $this->dropTable('{{%order_payment_type}}');
        $this->dropTable('{{%order_shipping_type}}');
        $this->dropTable('{{%order}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200418_160103_drop_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200418_160103_drop_tables cannot be reverted.\n";

        return false;
    }
    */
}
