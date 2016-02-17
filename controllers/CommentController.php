<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\SiteController;
use app\models\Comment;

/**
 * Контроллер для взаимодействия с таблицей
 * comments.
 */
class CommentController extends Controller
{

  /**
   * Переменная, отключающая валидацию CSRF
   * @var boolean
   */
  public $enableCsrfValidation = false;


  /**
   * Добавление нового комментария
   * @param  integer $id   Идентификатор задания, которому принадлежит комментарий
   * @param  string $text  Текст комментария 
   * @return redirect      После выполнения редиректит на главную.
   */
  public function actionNew($id, $text)
  {

    //Определение текущего языка
    SiteController::locale();

    //Определение полей для заполнения
    $comment = new Comment();
    $comment->task_id = $id;
    $comment->text = $text;
    $comment->date = date('Y-m-d H:i:s');

    //В зависимости от успеха сохранения, пишет в память сообщение от успехе или лог ошибок
    if ($comment->save())
    {
      Yii::$app->session->setFlash('success', Yii::t('msg/msg', 'Комментарий добавлен'));
    }
    else
    {
      Yii::$app->session->setFlash('errors', $comment->errors);
    }
    return $this->redirect("/");
  }

  /**
   * Удаление комментария
   * @param  integer $id   Идентификатор удаляемой записи
   * @return redirect      После выполнения редиректит на главную.
   */
  public function actionDelete($id)
  {

    //Определение текущего языка
    SiteController::locale();
    
    //Поиск по идентификатору
    $comment = Comment::findOne($id);

    //В зависимости от успеха удаления, пишет в память сообщение от успехе или лог ошибок
    if($comment->delete())
    {
      Yii::$app->session->setFlash('success', Yii::t('msg/msg', 'Комментарий удален'));
    }
    else
    {
      Yii::$app->session->setFlash('errors', $comment->errors);
    }
    
    return $this->redirect("/");
  }
}