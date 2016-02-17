<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Comment;

class CommentController extends Controller
{
  public $layout = "task";
  public $enableCsrfValidation = false;

  public function actionNew($id, $text)
  {
    $comment = new Comment();
    $comment->task_id = $id;
    $comment->text = $text;
    $comment->date = date('Y-m-d H:i:s');
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

  public function actionDelete($id)
  {
    $comment = Comment::findOne($id);
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