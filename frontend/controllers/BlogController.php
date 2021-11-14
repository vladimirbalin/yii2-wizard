<?php

namespace frontend\controllers;

use common\models\Post;

class BlogController extends \yii\web\Controller
{
    const LATEST_POST_LIMIT = 10;

    public function actionIndex()
    {
        $model = Post::find()->limit(self::LATEST_POST_LIMIT)->orderBy(['created_at' => SORT_DESC])->all();
        return $this->render('index', ['model' => $model]);
    }

    public function actionView($id)
    {
        $model = Post::findOne($id);
        return $this->render('view', compact('model'));
    }

}
