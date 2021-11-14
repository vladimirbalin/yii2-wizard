<?php

namespace frontend\controllers;

use common\models\Order;
use frontend\components\PageMessageTrait;
use frontend\models\EventOrderForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{
    use PageMessageTrait;
    public $bodyClass = 'profile-page';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /** @var \common\models\User $model */
        $model = Yii::$app->user->getIdentity();
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getOrders()->limit(20),
            'pagination' => false,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ]
        ]);
        return $this->render('index', ['model' => $model, 'dataProvider' => $dataProvider]);
    }

    public function actionEdit()
    {
        /** @var \common\models\User $model */

        $model = Yii::$app->user->getIdentity();
        $model->scenario = \common\models\User::SCENARIO_EDIT_PROFILE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirectToSuccessPage('Profile successfully edited', 'Alright');
            return  $this->render('index', ['model' => $model]);
        }

        return $this->render('edit', ['model' => $model]);
    }

    public function actionOrderDetails($id){
        $model = Order::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            $this->refresh();
        }
        return $this->render('order-details', ['model' => $model]);
    }
}
