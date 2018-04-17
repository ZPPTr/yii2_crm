<?php
namespace backend\controllers;

use common\components\keyStorage\FormModel;
use Yii;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';
        return parent::beforeAction($action);
    }

    public function actionSettings()
    {
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('backend', 'Frontend maintenance mode'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled')
                    ]
                ],
                'backend.theme-skin' => [
                    'label' => Yii::t('backend', 'Backend theme'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'skin-black' => 'skin-black',
                        'skin-blue' => 'skin-blue',
                        'skin-green' => 'skin-green',
                        'skin-purple' => 'skin-purple',
                        'skin-red' => 'skin-red',
                        'skin-yellow' => 'skin-yellow'
                    ]
                ],
                'backend.layout-fixed' => [
                    'label' => Yii::t('backend', 'Fixed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-boxed' => [
                    'label' => Yii::t('backend', 'Boxed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-collapsed-sidebar' => [
                    'label' => Yii::t('backend', 'Backend sidebar collapsed'),
                    'type' => FormModel::TYPE_CHECKBOX
                ]
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('settings', ['model' => $model]);
    }

	public function actionCreateFieldsCoefficient()
	{
		$products = Yii::$app->db->createCommand('SELECT id FROM products')->queryColumn();
		$countries = Yii::$app->db->createCommand('SELECT id FROM net_country WHERE is_active=1')->queryColumn();

		$checkProcess = false;
		foreach ($products as $product_id) {
			foreach ($countries as $country_id) {
				$coefficient = Yii::$app->db->createCommand('
					SELECT * FROM price_coefficients 
					WHERE country_id='.$country_id.' 
					AND product_id='.$product_id)
					->queryOne();
				if(!$coefficient) {
					$checkProcess = Yii::$app->db->createCommand()->insert('price_coefficients', [
						'country_id' => $country_id,
						'product_id' => $product_id,
						'price_coefficient' => 1,
						'price_purchase_coefficient' => 1,
						'is_available' => 0
					])->execute();
				}

			}

		}

		if ($checkProcess) {
			Yii::$app->getSession()->setFlash('alert', [
				'body'=>Yii::t('backend', 'Поля коэффициэнтов цен были успешно добавленны'),
				'options'=>['class'=>'alert-success']
			]);
		} else {
			Yii::$app->getSession()->setFlash('alert', [
				'body'=>Yii::t('backend', 'Небыло затронуто ни одного поля'),
				'options'=>['class'=>'alert-danger']
			]);
		}

		return $this->goBack();
    }
}
