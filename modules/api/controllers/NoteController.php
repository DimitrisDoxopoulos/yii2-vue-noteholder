<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\resources\NoteResource;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;

/**
 * Class NoteController
 * @package app\modules\api\controllers
 */
class NoteController extends ActiveController
{
    public $modelClass = NoteResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // Options 1: Authenticator works on every action except options
//        $behaviors['authenticator']['except'] = ['options'];
//        $behaviors['authenticator']['authMethods'] = [
//            HttpBearerAuth::class
//        ];
//        $behaviors['cors'] = [
//            'class' => Cors::class
//        ];

        // Options 2: Remove authenticator, Add Cors and then Add authenticator
        $auth = $behaviors['authenticator'];
        $auth['authMethods'] = [
            HttpBearerAuth::class
        ];
        unset($behaviors['authenticator']);
        $behaviors['cors'] = [
            'class' => Cors::class
        ];
        $behaviors['authenticator'] = $auth;

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        return new ActiveDataprovider([
            'query' => $this->modelClass::find()->byUser(Yii::$app->user->id)
        ]);
    }
}