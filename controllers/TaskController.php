<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Task;
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
        ->orderBy(['status'=>SORT_DESC , 'date'=>SORT_DESC])
        ->all();
    return $this->render('index', ['data'=>$data]);
  }

  public function actionNew()
  {
    $task = new Task();
    $task->title = $_POST['title'];
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

}
