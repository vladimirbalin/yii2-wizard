<?php

namespace frontend\controllers;

use common\models\Table;
use frontend\components\PageMessageTrait;
use frontend\models\EventOrderForm;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class EventController extends \yii\web\Controller
{
    use PageMessageTrait;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'select-event' => ['get', 'post'],
                    'number-of-tables' => ['post'],
                    'select-date' => ['post'],
                    'extra-items' => ['post'],
                    'submit-order' => ['post'],
                ],
            ],
        ];
    }
    public function actionSelectEvent()
    {
        /** @var EventOrderForm $model */
        $model = new EventOrderForm();
        $model->setScenario(EventOrderForm::SCENARIO_STEP_1_SELECT_EVENT);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setScenario(EventOrderForm::SCENARIO_STEP_2_NUMBER_OF_TABLES);
            return $this->render('number-of-tables', [
                'model' => $model,
                'tables' => \common\models\Table::find()->all()
            ]);
        }
        return $this->render('select-event', ['model' => $model, 'events' => \common\models\Event::find()->all()]);
    }
    public function actionNumberOfTables()
    {
        /** @var EventOrderForm $model */

        $model = new EventOrderForm();
        $model->setScenario(EventOrderForm::SCENARIO_STEP_2_NUMBER_OF_TABLES);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $custom = Table::findOne(['is_custom' => true]);

            if ($model->tableId == $custom->id) {
                return $this->redirect(['site/contact']);
            }
            $model->setScenario(EventOrderForm::SCENARIO_STEP_3_SELECT_DATE);
            return $this->render('select-date', ['model' => $model]);
        }
    }
    public function actionSelectDate()
    {
        /** @var EventOrderForm $model */
        $model = new EventOrderForm();
        $model->setScenario(EventOrderForm::SCENARIO_STEP_3_SELECT_DATE);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setScenario(EventOrderForm::SCENARIO_STEP_4_EXTRA_ITEMS);
            return $this->render('extra-items', [
                'model' => $model,
            ]);
        }
        return $this->render('select-date', ['model' => $model]);
    }
    public function actionExtraItems()
    {
        $model = new EventOrderForm();
        $model->setScenario(EventOrderForm::SCENARIO_STEP_4_EXTRA_ITEMS);
        if (
            \yii\base\Model::loadMultiple($model->extraItemForms, Yii::$app->request->post()) &&
            Model::validateMultiple($model->extraItemForms) &&
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {
            $model->setScenario(EventOrderForm::SCENARIO_STEP_5_SUBMIT_ORDER);
            return $this->render('submit-order', ['model' => $model]);
        }


        return $this->render('extra-items', ['model' => $model]);
    }
    public function actionSubmitOrder()
    {
        $model = new EventOrderForm();
        $model->setScenario(EventOrderForm::SCENARIO_STEP_5_SUBMIT_ORDER);
        if (
            \yii\base\Model::loadMultiple($model->extraItemForms, Yii::$app->request->post()) &&
            Model::validateMultiple($model->extraItemForms) &&
            $model->load(Yii::$app->request->post()) &&
            $model->validate()
        ) {
            $model->submit(Yii::$app->user->id);
            $this->redirectToSuccessPage(
                'Order has been placed',
                'Your order has been placed. Please complete the payment transfer and enter the transaction code into the system, this can be done on your profile page.'
            );
        }
        return $this->render('submit-order', ['model' => $model]);
    }
}
