<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;

class SiteController extends Controller
{

    private static function getTasks()
    {
        $data = Task::find()->all();
        return $data;
    }

    public function actionLocale($lang)
    {
        Yii::$app->session->set('language', $lang);
        return $this->redirect("/");
    }

    public function actionEmail()
    {
        $data = self::getTasks();
        $mail = Yii::$app->mailer->compose('mail', ['data'=>$data])
                ->setFrom('rikosage@mail.ru')
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Новое письмо');
        if ($mail->send())
        {
            Yii::$app->session->setFlash('success', Yii::t('msg/msg', 'Письмо отправлено'));
        }
        else
        {
            Yii::$app->session->setFlash('errors', Yii::t('msg/msg', 'Что-то пошло не так, письмо не отправлено'));
        }
        
    }
}
