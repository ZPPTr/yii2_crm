<?php

namespace backend\controllers;

use common\models\Question;
use common\models\services\QuestService;
use Yii;
use yii\helpers\Url;
use common\models\QuestPack;
use backend\models\search\QuestPackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestsPackController implements the CRUD actions for QuestPack model.
 */
class QuestsPackController extends Controller
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
     * Lists all QuestPack models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestPackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestPack model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new QuestPack model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuestPack();
		$questions = $model->questions;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'questions' => $questions,
            ]);
        }
    }

    /**
     * Updates an existing QuestPack model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$questions_list = $model->questions;
		$new_question = new Question(['quest_pack_id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'questions_list' => $questions_list,
				'new_question' => $new_question,
            ]);
        }
    }

    /**
     * Deletes an existing QuestPack model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the QuestPack model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestPack the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestPack::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionAddQuestion()
	{
		QuestService::addQuestion(Yii::$app->request->post());
		return $this->redirect(Url::previous());
    }

	public function actionDeleteQuestion($id)
	{
		QuestService::deleteQuestion($id);
		return $this->redirect(Url::previous());
    }

	public function actionUpdateQuestion($id)
	{
		$model = Question::findOne($id);
		$answers_list = $model->answers;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(Url::previous());
		} else {
			return $this->render('update-question', [
				'model' => $model,
				'answers_list' => $answers_list,
			]);
		}
    }

	public function actionAddAnswer()
	{
		QuestService::addAnswer(Yii::$app->request->post());

		return $this->redirect(Url::previous('question'));
    }

	public function actionDeleteAnswer($id)
	{
		QuestService::deleteAnswer($id);
		return $this->redirect(Url::previous('question'));
	}

}
