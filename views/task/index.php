<?php use yii\bootstrap\Alert; ?>

<?php $this->title = 'Task'; ?>

<?php  
  if (Yii::$app->session->hasFlash('errors'))
  {
    foreach (Yii::$app->session->getFlash('errors') as $error)
    {
      echo Alert::widget([
      'options' => [
          'class' => 'alert-danger'
      ],
      'body' => $error[0]
      ]);
    }
  }
  
  if (Yii::$app->session->hasFlash('success'))
  {
    echo Alert::widget([
      'options' => [
          'class' => 'alert-success'
      ],
      'body' => Yii::$app->session->getFlash('success')
      ]);
  }
?>



<div class="row">
  <div class="add-container col-lg-8 col-lg-offset-2">
    <form action="/task/new" method = "post">
      <label>Введите название нового задания</label>
      <input class = "form-control" type="text" name = "title" />
      <button type = "submit" class = "btn btn-success">Создать</button>
    </form>
  </div>
</div>

<div class="task-container col-lg-8 col-lg-offset-2">
  <?php foreach ($data as $task){ ?>
    <div class="task">
     <div class="title"><h2 class = "text-center"><?php echo $task->title; ?></h2></div>
    </div>
  <?php } ?>
</div>