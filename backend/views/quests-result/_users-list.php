<?php
/***
 * @var $usersList array
 */

foreach($usersList as $user) {
	echo \yii\helpers\Html::tag('li',
		\yii\helpers\Html::a($user['name'].' '.$user['surname'], ['/users/view', 'id' => $user['user_id']], ['target' => '_blank']).
		\yii\helpers\Html::tag('span', $user['phone'] . ' (' .$user['number']. ')')
	);
}



