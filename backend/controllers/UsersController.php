<?php

namespace backend\controllers;

use common\models\QuestHistory;
use common\models\Question;
use common\models\QuestPack;
use common\models\services\QuestService;
use Yii;
use common\models\Users;
use backend\models\search\UsersSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);
    	$orders = $model->userOrders;
    	$quests = $model->userQuests;

    	$allowed_quests = QuestPack::find()->all();

        return $this->render('view', [
            'model' => $model,
			'orders' => $orders,
			'quests' => $quests,
			'allowed_quests' => $allowed_quests,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionCreateQuest()
	{
		QuestService::attachQuestToUser(Yii::$app->request->post());

		$model = $this->findModel(Yii::$app->request->post('user_id'));
		$quests = $model->userQuests;

		$allowed_quests = QuestPack::find()->all();

		return $this->renderPartial('_questions-list', [
			'quests' => $quests,
			'allowed_quests' => $allowed_quests,
			'user_id' => Yii::$app->request->post('user_id'),
		]);
    }

    public function actionRunQuest($quest_id, $user_id)

	{

		$quest = QuestPack::findOne($quest_id);
		$questHistory = QuestHistory::find()->where(['quest_pack_id' => $quest_id, 'user_id' => $user_id])->all();

		return $this->render('quest-run', [
			'quest' => $quest,
			'user_id' => $user_id,
			'quest_history' => $questHistory,
		]);
	}

    public function actionInsertQuestHistory()
	{

		QuestService::insertQuestHistory(Yii::$app->request->post());

		return $this->redirect(Url::previous());
	}

	public function actionClearAllQuestHistory($user_id = false)
	{
    	$condition = $user_id ? 'user_id='.$user_id : 'true';
    	Yii::$app->db->createCommand('DELETE FROM quest_history WHERE '.$condition)->execute();

		return $this->redirect(Url::previous());
	}
}
