<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m200503_111248_prices_permissions
 */
class m200503_111248_prices_permissions extends Migration
{
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

        $p = $auth->createPermission('prices');
        $p->description = 'view prices page';
        $auth->add($p);

        $addEdit = $auth->createPermission('addEditPrices');
        $auth->add($addEdit);

        $delete = $auth->createPermission('deletePrice');
        $auth->add($delete);

        $auth->addChild($p, $addEdit);
        $auth->addChild($p, $delete);
        $auth->addChild($auth->getRole('admin'), $p);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200503_111248_prices_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_111248_prices_permissions cannot be reverted.\n";

        return false;
    }
    */
}
