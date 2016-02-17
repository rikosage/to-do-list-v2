<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Task;


/**
 * Класс описывает общие методы при работе с приложением
 */
class SiteController extends Controller
{

    /**
     * Определение текущего языка
     */
    
    public static function locale()
    {
        Yii::$app->language = Yii::$app->session->get('language');
    }


    /**
     * Статический метод, возвращающий все поля таблицы tasks
     * @return object
     */
    
    private static function getTasks()
    {
        $data = Task::find()->all();
        return $data;
    }


    /**
     * Установка требуемого языка
     * @param  string $lang  Язык в формате en-US
     * @return redirect      Редиректит на главную страницу
     */
    public function actionLocale($lang)
    {
        Yii::$app->session->set('language', $lang);
        return $this->redirect("/");
    }

    /**
     * Отправка сообщения с активными задачами на почту, указанную в config/params.php
     * @return redirect      Редиректит на главную страницу и устанавливает сообщение об успехе
     *                       или лог ошибок
     */
    
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
        
        return $this->redirect("/");
    }
}
