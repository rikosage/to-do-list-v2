<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\SiteController;
use app\models\Task;
use app\models\Comment;


/**
 * Класс для работы с записями
 */
class TaskController extends Controller
{

  /**
   * Стандартный шаблон вывода
   * @var string
   */
  
  public $layout = "task";

  /**
   * Отключение CSRF-валидации данных
   * @var boolean
   */
  
  public $enableCsrfValidation = false;


  /**
   * Выборка из базы данных с сортировкой и отрисовка главного view
   * @return view
   */
  
  public function actionIndex()
  {
    //Определение языка
    SiteController::locale();

    //Выборка из таблицы tasks с комментариями из comments, отсортированные по дате и активности
    $data = Task::find()
        ->with('comment')
        ->orderBy(['status'=>SORT_DESC , 'date'=>SORT_DESC])
        ->all();

    //Отрисовка главного представления
    return $this->render('index', ['data'=>$data]);
  }


  /**
   * Добавление нового задания в таблицу
   * @param  string $title Название задания
   * @return redirect
   */
  
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


  /**
   * Изменение определенной записи
   * @param  integer $id     Идентификатор изменяемой записи
   * @param  string $title   Новое название для записи
   * @param  boolean $status Активность. По умолчанию - активно.
   * @return redirect 
   */
  
  public function actionChange($id, $title, $status = Task::STATUS_ACTIVE)
  {
    //Определение текущего языка
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

  /**
   * Удаление определенной записи
   * @param  integer $id Идентификатор удаляемой записи
   * @return redirect
   */
  
  public function actionDelete($id)
  {

    //Определение текущего языка
    SiteController::locale();

    //Поиск задания по идентификатору
    $task = Task::findOne($id);

    //Удаление всех связанных с заданием комментариев
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
