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
      Yii::$app->session->setFlash('success', Yii::t('msg/msg', 'Запись добавлена'));
    }
    else
    {
      Yii::$app->session->setFlash('errors', $task->errors);
    }
    return $this->redirect("/");
  }

  public function actionChange($id, $title, $status = Task::STATUS_ACTIVE)
  {
    $task = Task::findOne($id);
    $task->title = $title;
    $task->date = date('Y-m-d H:i:s');
    $task->status = $status;
    if($task->save())
    {
      Yii::$app->session->setFlash('success', Yii::t('msg/msg', 'Запись обновлена'));
    }
    else
    {
      Yii::$app->session->setFlash('errors', $task->errors);
    }

    return $this->redirect("/");
  }

  public function actionDelete($id)
  {
    $task = Task::findOne($id);
    $commentDeleted = Comment::deleteAll(["task_id" => $id]);
    if($task->delete() && $commentDeleted)
    {
      Yii::$app->session->setFlash('success', Yii::t('msg/msg', 'Удалена'));
    }
    else
    {
      Yii::$app->session->setFlash('errors', $task->errors);
    }

    return $this->redirect("/");
  }

  public function actionNewComment($id, $text)
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

  public function actionDeleteComment($id)
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

  public function actionLocale($lang)
  {
    Yii::$app->session->set('language', $lang);
    return $this->redirect("/");
  }
}
