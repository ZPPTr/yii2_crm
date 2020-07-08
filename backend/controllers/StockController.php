<?php

namespace backend\controllers;

use common\models\shop\Product;
use common\models\stocks\Stock;
use common\models\stocks\StockItems;
use common\models\stocks\StockOrder;
use common\models\stocks\StockOrderItems;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'clear' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stock models.
     * @return mixed
     * @throws InvalidConfigException
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => Yii::createObject(Stock::className())->search(Yii::$app->request->queryParams),
        ]);
    }

    /**
     * Displays a single SystemLog model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing SystemLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @return String
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDeleteStockItem()
    {
        $model = StockItems::findOne(Yii::$app->request->getBodyParam('id'));

        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return Json::encode($model->toArray());
    }

    /**
     * @return string
     */
    public function actionOrders()
    {
        $searchModel = new StockOrder();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('orders', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionUpdateOrder($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StockOrderItems::find(),
        ]);
        $dataProvider->query->andWhere(['order_id' => $id]);

        return $this->render('order-update', [
            'model' => StockOrder::findOne($id),
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDeleteOrderItem($id)
    {
        $model = StockOrderItems::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $orderId = $model->order->id;

        $model->delete();

        return $this->redirect('update-order?id='.$orderId);
    }

    /**
     * @param $id //OrderId
     * @return string
     * @throws NotFoundHttpException|InvalidConfigException
     */
    public function actionAddOrderItem($id)
    {
        if (!$order = StockOrder::findOne($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if (Yii::$app->request->isAjax && Yii::$app->request->isGet) {
            $model = new StockOrderItems();

            return $this->renderPartial('_add-item-form', [
                'orderId' => $id,
                'model' => $model,
                'products' => Product::getProductsDropDown()
            ]);
        }

        if (Yii::$app->request->isPost) {
            $item = $order->addItem(Yii::$app->request->post('StockOrderItems'));
            Yii::$app->session->setFlash('stock-order-item', $item->hasErrors()
                ? 'Не удалось добавить позициюю Возникли следующие ошибки: '.Json::encode($item->errors)
                : 'Позиция была успешно добавлена к заказу.');

            $this->redirect('update-order?id='.$id);
        }
    }

    /**
     * Finds the SystemLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
