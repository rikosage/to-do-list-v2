<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\SiteController;
use app\models\Task;
use app\models\Comment;


/**
 * Task controller
 */
class TaskController extends Controller
{

  public $layout = "task";
  public $enableCsrfValidation = false;

  public function actionIndex()
  {
    SiteController::locale();

    $data = Task::find()
        ->with('comment')
        ->orderBy(['status'=>SORT_DESC , 'date'=>SORT_DESC])
        ->all();
    return $this->render('index', ['data'=>$data]);
  }

  public function actionNew($title)
  {
    SiteController::locale();

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
    SiteController::locale();

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
    SiteController::locale();

    $task = Task::findOne($id);
    $commentDeleted = Comment::deleteAll(["task_id" => $id]);
    if($task->delete())
    {
      Yii::$app->session->setFlash('success', Yii::t('msg/msg', 'Запись удалена'));
      return $this->redirect("/");
    }
    else
    {
      Yii::$app->session->setFlash('errors', $task->errors);
    }
  }

}
