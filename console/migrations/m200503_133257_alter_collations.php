<?php

use yii\db\Migration;

/**
 * Class m200503_133257_alter_collations
 */
class m200503_133257_alter_collations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE `prices` CHANGE `article` `article` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;');
        $this->execute('ALTER TABLE `prices` CHANGE `title` `title` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;');
        $this->execute('ALTER TABLE `prices` CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200503_133257_alter_collations cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_133257_alter_collations cannot be reverted.\n";

        return false;
    }
    */
}
