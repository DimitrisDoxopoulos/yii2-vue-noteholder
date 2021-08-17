<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\models\SignupForm;
use app\modules\api\models\LoginForm;
use yii\base\Exception;
use yii\rest\Controller;

/**
 * Class DefaultController
 *
 * @package app/modules/api/controllers
*/

class UserController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login())
        {
            return $model->getUser();
        }

        Yii::$app->response->statusCode = 422;
        $model->password = '';
        return [
          'errors' => $model->errors
        ];
    }


    /**
     * @throws Exception
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->register())
        {
            return $model->_user;
        }

        Yii::$app->response->statusCode = 422;
        $model->password = '';
        return [
            'errors' => $model->errors
        ];
    }
}