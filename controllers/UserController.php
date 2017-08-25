<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.08.2017
 * Time: 18:13
 */

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class UserController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    public $modelClass = '\app\models\Users';

}