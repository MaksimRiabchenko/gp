<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180413_105309_item_options_permissions
 */
class m180413_105309_item_options_permissions extends Migration
{
    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = $this->getAuthManager();

        $itemOptions = $auth->createPermission('itemOptions');
        $itemOptions->description = 'view item options page';
        $auth->add($itemOptions);

        $addEditItemOption = $auth->createPermission('addEditItemOption');
        $auth->add($addEditItemOption);

        $deleteItemOption = $auth->createPermission('deleteItemOption');
        $auth->add($deleteItemOption);

        $auth->addChild($itemOptions, $addEditItemOption);
        $auth->addChild($itemOptions, $deleteItemOption);
        $auth->addChild($auth->getRole('admin'), $itemOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_105309_item_options_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_105309_item_options_permissions cannot be reverted.\n";

        return false;
    }
    */
}
