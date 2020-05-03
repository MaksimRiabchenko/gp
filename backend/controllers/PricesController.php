<?php

namespace backend\controllers;

use Yii;
use common\models\Price;
use backend\models\forms\PriceForm;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use common\helpers\UserHelper;

class PricesController extends BaseController
{

    public $modelClass = Price::class;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function () {
                    throw new ForbiddenHttpException('Access denied');
                },
                'rules' => [
                    [
                        'actions' => ['index'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['prices', 'addEditPrices', 'deletePrice'],
                    ],
                    [
                        'actions' => ['create', 'update'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['addEditPrices'],
                    ],
                    [
                        'actions' => ['delete'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['deletePrice'],
                    ],
                    [    // all the action are accessible to admin
                        'allow' => true,
                        'roles' => ['admin'], //
                    ],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only' => ['get-options']
            ],
        ];
    }

    /**
     * @param int|null $id
     * @return PriceForm|string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate(int $id = null)
    {
        $formModel = new PriceForm();
        $formModel = $this->processData($formModel);

        if ($formModel instanceof PriceForm) {

            return $this->render('create', [
                'action' => 'create',
                'formModel' => $formModel
            ]);
        }

        return $formModel;
    }

    public function actionUpdate(int $id)
    {
        /** @var Price $model */
        $model = $this->getModel($id);

        $formModel = new PriceForm();
        $formModel = $this->processData($formModel, $model);

        if ($formModel instanceof PriceForm) {
            // if not post set attrs from model
            $formModel->setAttributes($model->getAttributes());

            return $this->render('create', [
                'price' => $model,
                'action' => 'update',
                'formModel' => $formModel,
            ]);
        }

        return $formModel;
    }

    /**
     * @param PriceForm $formModel
     * @param bool $model
     * @return PriceForm|\yii\web\Response
     * @throws \Exception
     */
    private function processData(PriceForm $formModel, $model = false)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());

                if ($formModel->validate()) {

                    if (!$model) {
                        $model = new Price();
                    }
                    $model->setAttributes($formModel->getAttributes());

                    if ($model->save()) {
                        $this->setFlash('success', Yii::t('app', 'Success!'));
                        return $this->redirect(['prices/index/']);
                    } else {
                        $this->setFlash('error', 'Cant save model: ' . print_r($model->getErrors(), 1));
                    }
                } else {
                    $this->setFlash('error', 'Cant validate form');
                }
            } catch
            (Exception $e) {
            }
        }

        return $formModel;
    }

    /**
     * @param int|null $id
     * @return string
     */
    public function actionIndex(int $id = null)
    {
        $prices = UserHelper::hasRole('admin') ?
            Price::find() :
            Price::find(['user_id' => Yii::$app->user->id]);

        $viewData['dataProvider'] = new ActiveDataProvider([
            'query' => $prices,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', $viewData);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        /** @var Price $model */
        $model = $this->getModel($id);

        $model->deletePrice() ?
            $this->setFlash('success', Yii::t('app', 'Deleted')) :
            $this->setFlash('error', 'Cant delete price');

        return $this->redirect(['prices/index/']);
    }

}
