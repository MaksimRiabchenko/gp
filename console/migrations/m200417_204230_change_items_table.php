<?php

use yii\db\Migration;

/**
 * Class m200417_204230_change_items_table
 */
class m200417_204230_change_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200417_204230_change_items_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropColumn('{{%items}}', 'article');
        $this->dropColumn('{{%items}}', 'category_id');
        $this->dropColumn('{{%items}}', 'video_url');
        $this->dropColumn('{{%items}}', 'price');
    }

    /*public function down()
    {
        echo "m200417_204230_change_items_table cannot be reverted.\n";

        return false;
    }
    */
}
