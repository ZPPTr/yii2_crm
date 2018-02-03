<?php

namespace backend\controllers;

use common\models\QuestHistory;
use common\models\Question;
use common\models\QuestPack;
use common\models\QuestResult;
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
    	$questPackId = Yii::$app->request->get('UsersSearch')['questPackId'] ? Yii::$app->request->get('UsersSearch')['questPackId'] : 0;
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'questList' => QuestPack::find()->select('title')->indexBy('id')->column(),
			'questPackId' => $questPackId,
        ]);
    }


	/**
	 * Lists User models for decrease balance.
	 * @return mixed
	 */
	public function actionUsersDecreaseBalance()
	{
		$searchModel = new UsersSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query
			->joinWith(['userReportLastMonth'])
			->andWhere(['is_auto_pay' => true])
			->andWhere(['>', 'profit', 50]);

		return $this->render('decrease-balance', [
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

	public function actionAjaxUpdate($id)
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$user = $this->findModel($id);

		if ($user->load(Yii::$app->request->post())){
			$attribute = array_keys(Yii::$app->request->post()['Users']);
			if ($user->validate($attribute)){
				$transaction = Yii::$app->db->beginTransaction();
				try {
					$user->tryUpdate(false);

					$transaction->commit();
					switch($attribute[0]){
						case 'city':
							return ['output' => $user->city ? $user->city : '', 'message'=>''];
							break;
						default:
							$attr = $attribute[0];
							return ['output'=>$user->$attr, 'message'=>''];
					}

				} catch (\Exception $e) {
					$transaction->rollBack();
					throw $e;
				}
			}else{
				return [
					'output' => '',
					'message' => $user->getErrors()
				];
			}
		}

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
		$questResult = QuestResult::find()->where(['quest_pack_id' => $quest_id, 'user_id' => $user_id])->one();
		$questHistory = QuestHistory::find()->where(['quest_pack_id' => $quest_id, 'user_id' => $user_id])->all();

		//_debug(Yii::$app->request->post(),true);
		//echo var_dump(strtotime('Wed, 30/08/2017 12:12'));
		if ($questResult->load(Yii::$app->request->post())) {
			//_debug(($questResult), true);
				if($questResult->save()) {
					return $this->refresh();
			}

		} else {
			return $this->render('_quest-run', [
				'quest' => $quest,
				'user_id' => $user_id,
				'quest_history' => $questHistory,
				'quest_result' => $questResult,
			]);
		}
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
