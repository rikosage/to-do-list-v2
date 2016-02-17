<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionLocale($lang)
    {
        Yii::$app->session->set('language', $lang);
        return $this->redirect("/");
    }
}
