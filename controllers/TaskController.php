<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Task;
use app\models\Comment;
use yii\bootstrap\Alert;

/**
 * Task controller
 */
class TaskController extends Controller
{

  public $layout = "task";
  public $enableCsrfValidation = false;

  public function actionIndex()
  {
    $data = Task::find()
        ->with('comment')
        ->orderBy(['status'=>SORT_DESC , 'date'=>SORT_DESC])
        ->all();
    return $this->render('index', ['data'=>$data]);
  }

  public function actionNew($title)
  {
    $task = new Task();
    $task->title = $title;
    $task->status = Task::STATUS_ACTIVE;
    $task->date = date('Y-m-d H:i:s');
    if($task->save())
    {
      Yii::$app->session->setFlash('success', "Сообщение добавлено");
    }
    else
    {
      Yii::$app->session->setFlash('errors', $task->errors);
    }
    return $this->redirect("/");
  }

  public function actionChange($id, $title)
  {
    $task = Task::findOne($id);
    $task->title = $title;
    if($task->save())
    {
      Yii::$app->session->setFlash('success', "Запись обновлена");
    }
    else
    {
      Yii::$app->session->setFlash('errors', $task->errors);
    }

    return $this->redirect("/");
  }

  public function actionDelete()
  {

  }

  public function actionNewComment($id, $text)
  {
    $comment = new Comment();
    $comment->task_id = $id;
    $comment->text = $text;
    $comment->date = date('Y-m-d H:i:s');
    if ($comment->save())
    {
      Yii::$app->session->setFlash('success', "Комментарий добавлен");
    }
    else
    {
      Yii::$app->session->setFlash('errors', $comment->errors);
    }
    return $this->redirect("/");
  }

  public function actionDeleteComment($id)
  {
    $comment = Comment::findOne($id);
    if($comment->delete())
    {
      Yii::$app->session->setFlash('success', "Комментарий удален");
    }
    else
    {
      Yii::$app->session->setFlash('errors', $comment->errors);
    }
    
    return $this->redirect("/");
  }

}
