<?php

namespace frontend\components;

use Yii;
use yii\helpers\VarDumper;

/**
 * PageMessageTrait
 *
 * Provide easy access for \yii\web\Controller, for show error and success messages on a separate page
 * For usage, you must use this trait in your Controller and create two views, in your view path:
 * - page-message/success.php
 * - page-message/error.php
 *
 * You can use this trait like this:
 * ```php
 * class ExampleController {
 * use PageMessageTrait;
 * ...
 * public function actionExample() {
 *     ...
 *     if ($success) {
 *         return $this->redirectToSuccessPage('Success', 'Your action completed successfully');
 *     } else {
 *         return $this->redirectToErrorPage('Internal Error', 'Your action finished with error');
 *     }
 *     ...
 * }
 * ```
 */
trait PageMessageTrait
{
    /**
     * @see \yii\web\Controller
     *
     * @param string|array $url
     * @param int $statusCode
     * @return \yii\web\Response
     */
    abstract public function redirect($url, $statusCode = 302);

    /**
     * @see \yii\base\Controller
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    abstract public function render($view, $params = []);

    /**
     * @see \yii\web\Controller
     *
     * @return \yii\web\Response
     */
    abstract public function goHome();

    /**
     * Store success message to user session and redirect to success-info action
     *
     * @param string $title
     * @param string $description
     *
     * @return \yii\web\Response
     */
    public function redirectToSuccessPage($title, $description)
    {
        Yii::$app->session->set('page-message.success.title', $title);
        Yii::$app->session->set('page-message.success.description', $description);

        return $this->redirect(['success-info']);
    }

    /**
     * Store error message to user session and redirect to error-info action
     *
     * @param string $title
     * @param string $description
     *
     * @return \yii\web\Response
     */
    public function redirectToErrorPage($title, $description)
    {
        Yii::$app->session->set('page-message.error.title', $title);
        Yii::$app->session->set('page-message.error.description', $description);

        return $this->redirect(['error-info']);
    }

    /**
     * Get success message from user session and render this message on a separate page
     *
     * @return string
     */
    public function actionSuccessInfo()
    {
        $title = Yii::$app->session->get('page-message.success.title');
        $description = Yii::$app->session->get('page-message.success.description');
        Yii::$app->session->remove('page-message.success.title');
        Yii::$app->session->remove('page-message.success.description');

        if (empty($title) || empty($description)) {
            $this->goHome();
        }

        return $this->render('/page-message/success', [
            'title' => $title,
            'description' => $description
        ]);
    }

    /**
     * Get error message from user session and render this message on a separate page
     *
     * @return string
     */
    public function actionErrorInfo()
    {
        $title = Yii::$app->session->get('page-message.error.title');
        $description = Yii::$app->session->get('page-message.error.description');
        Yii::$app->session->remove('page-message.error.title');
        Yii::$app->session->remove('page-message.error.description');

        if (empty($title) || empty($description)) {
            $this->goHome();
        }

        return $this->render('/page-message/error', [
            'title' => $title,
            'description' => $description
        ]);
    }
}
