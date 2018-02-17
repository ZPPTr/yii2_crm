<?php
/**
 * Created by PhpStorm.
 * User: WP-Andrey
 * Date: 13.02.2018
 * Time: 20:54
 */

namespace common\models\services;


use yii\db\Query;

class QuestStatisticService
{
	public static function getUsersByAnswer($questPackId, $questionId, $answerId)
	{
		$users = (new \yii\db\Query())
			->select(['qh.user_id', 'u.number', 'u.phone', 'u.name', 'u.surname'])
			->from('quest_history as qh')
			->join('LEFT JOIN','users as u', 'u.id=qh.user_id')
			->where(['quest_pack_id' => $questPackId, 'question_id' => $questionId, 'answer_id' => $answerId])
			->limit(-1)
			->all();

		return $users;
	}
}