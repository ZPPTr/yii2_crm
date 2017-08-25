<?php

namespace backend\controllers;

use Yii;
use common\models\QuestResult;
use backend\models\search\QuestResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestsResultController implements the CRUD actions for QuestResult model.
 */
class QuestsResultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all QuestResult models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestResult model.
     * @param integer $quest_pack_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($quest_pack_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($quest_pack_id, $user_id),
        ]);
    }

    /**
     * Creates a new QuestResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuestResult();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'quest_pack_id' => $model->quest_pack_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QuestResult model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $quest_pack_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($quest_pack_id, $user_id)
    {
        $model = $this->findModel($quest_pack_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'quest_pack_id' => $model->quest_pack_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing QuestResult model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $quest_pack_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($quest_pack_id, $user_id)
    {
        $this->findModel($quest_pack_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the QuestResult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $quest_pack_id
     * @param integer $user_id
     * @return QuestResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($quest_pack_id, $user_id)
    {
        if (($model = QuestResult::findOne(['quest_pack_id' => $quest_pack_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
