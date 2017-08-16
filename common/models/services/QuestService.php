<?php

namespace common\models\services;

use common\models\Question;
use common\models\Answer;
use Yii;

class QuestService
{
	public static function addQuestion(array $fields)
	{
		$question = new Question([
			'title' => $fields['title'],
			'description' => $fields['description'],
			'parent_answer_id' => $fields['parent_answer_id'],
			'sorting' => $fields['sorting'],
			'quest_pack_id' => $fields['pack_id'],
		]);
		$question->save();
	}

	public static function deleteQuestion($id)
	{
		Yii::$app->db->createCommand("DELETE FROM question WHERE id=$id")->execute();
	}

	public static function addAnswer(array $fields)
	{
		$answer = new Answer([
			'title' => $fields['title'],
			'question_id' => $fields['question_id'],
		]);
		$answer->save();
	}

	public static function deleteAnswer($id)
	{
		Yii::$app->db->createCommand("DELETE FROM answer WHERE id=$id")->execute();
	}

}