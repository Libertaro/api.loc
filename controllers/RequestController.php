<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.08.2017
 * Time: 19:03
 */

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;
use Yii;
use yii\web\Response;

class RequestController extends Controller
{
    public function actionIndex()
    {
        $params['type'] = 'get';
        $users = $this->requestExecute($params);
        return $this->render('index', [
            'users' => $users,
        ]);
    }

    public function actionCreate()
    {
        $params = [
            'name' => Yii::$app->request->get('name'),
            'type' => 'post',
        ];
        $this->requestExecute($params);
    }

    public function actionFind()
    {
        $params = [
            'type' => 'get',
            'url'  => 'http://api.loc/users/'.Yii::$app->request->get('id'),
        ];
        $findUser = $this->requestExecute($params);
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $findUser['name'];
        }
    }

    public function actionEdit()
    {
        $params = [
            'type' => 'patch',
            'url'  => 'http://api.loc/users/'.Yii::$app->request->get('id'),
            'name' => Yii::$app->request->get('name'),
        ];
        $this->requestExecute($params);
    }

    public function actionDelete()
    {
        $params = [
            'type' => 'delete',
            'url'  => 'http://api.loc/users/'.Yii::$app->request->get('id'),
        ];
        $this->requestExecute($params);
    }

    public function requestExecute($params)
    {
        $url = isset($params['url']) ? $params['url'] : 'http://api.loc/users';
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod($params['type'])
            ->setUrl($url)
            ->setData(['name' => $params['name']])
            ->send();

        return $response->data;
    }
}