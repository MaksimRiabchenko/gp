<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\Item;
use common\models\ItemOptionValue;
use backend\models\forms\ItemForm;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use common\helpers\UserHelper;

class ItemsController extends BaseController
{

    public $modelClass = Item::class;

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
                        'permissions' => ['items', 'addEditItems', 'deleteItems'],
                    ],
                    [
                        'actions' => ['create', 'update'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['addEditItems'],
                    ],
                    [
                        'actions' => ['delete'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['deleteItems'],
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
     * @return ItemForm|string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate(int $id = null)
    {
        $formModel = new ItemForm();
        $formModel = $this->processData($formModel);

        if ($formModel instanceof ItemForm) {

            if ($id !== null) {
                $category = Category::findOne(['id' => $id]);
                if ($category) {
                    $formModel->setAttributes([
                        'category_id' => $category->id
                    ]);
                }
            }

            return $this->render('create', [
                'category' => !empty($category) ? $category : null,
                'action' => 'create',
                'formModel' => $formModel
            ]);
        }

        return $formModel;
    }

    public function actionUpdate(int $id)
    {
        /** @var Item $model */
        $model = $this->getModel($id);

        $formModel = new ItemForm();
        $formModel = $this->processData($formModel, $model);

        if ($formModel instanceof ItemForm) {
            // if not post set attrs from model
            $formModel->setAttributes($model->getAttributes());

            return $this->render('create', [
                'item' => $model,
                'action' => 'update',
                'formModel' => $formModel,
            ]);
        }

        return $formModel;
    }

    /**
     * @param ItemForm $formModel
     * @param bool $model
     * @return ItemForm|\yii\web\Response
     * @throws \Exception
     */
    private function processData(ItemForm $formModel, $model = false)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());
                $formModel->file = UploadedFile::getInstance($formModel, 'file');

                if ($formModel->validate()) {

                    if (!$model) {
                        $model = new Item();
                    }
                    $model->setAttributes($formModel->getAttributes());

                    if ($model->save()) {

                        if ($formModel->file) {
                            // save image
                            $model->deleteOldFile($model->logo);
                            $imagesPath = $model->getImagesPath();
                            if (!is_dir($imagesPath)) {
                                BaseFileHelper::createDirectory($imagesPath, 0777, true);
                            }

                            $imageName = $formModel->getFileName();
                            if ($formModel->file->saveAs($imagesPath . $imageName)) {
                                $model->setAttribute('logo', $imageName);
                                $model->save();
                            }
                        }

                        // item option values
                        foreach ($formModel->tmpItemOptions as $itemOptions) {
                            if ($model->isNewRecord) {
                                $itemOptionValue = new ItemOptionValue();
                            } else {
                                $itemOptionValue = $model->getItemOptionValue($itemOptions->id);
                                if (!$itemOptionValue) {
                                    $itemOptionValue = new ItemOptionValue();
                                }
                            }
                            $itemOptionValue->setAttributes([
                                'item_id' => $model->id,
                                'option_id' => $itemOptions->id,
                                'string' => $itemOptions->value
                            ]);

                            if (!$itemOptionValue->save()) {
                                $this->setFlash('error', 'Cant save item option value: ' . $itemOptions->id . ' = ' . $itemOptions->value);
                                return $this->redirect(['items/index']);
                            }
                        }

                        $this->setFlash('success', Yii::t('app', 'Success!'));
                        return $this->redirect(['items/index/']);
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

        $items = UserHelper::hasRole('admin') ?
            Item::find() :
            Item::find(['user_id' => Yii::$app->user->id]);

        if ($id !== null) {
            $items->andWhere(['category_id' => $id]);
            $viewData['category'] = Category::findOne(['id' => $id]);
            if (!$viewData['category']) {
                throw new NotFoundHttpException('Category not found');
            }
        }

        $viewData['dataProvider'] = new ActiveDataProvider([
            'query' => $items,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', $viewData);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionGetOptions(int $id)
    {
        $category = Category::findOne(['id' => $id]);

        return $this->renderPartial('item_options', ['options' => $category->itemOptions]);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        /** @var Item $model */
        $model = $this->getModel($id);

        $model->deleteItem() ?
            $this->setFlash('success', Yii::t('app', 'Deleted')) :
            $this->setFlash('error', 'Cant delete item');

        return $this->redirect(['items/index/']);
    }

}
