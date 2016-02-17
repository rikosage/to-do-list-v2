<?php use yii\bootstrap\Alert; ?>

<?php $this->title = 'Task'; ?>
<?php Yii::$app->language = Yii::$app->session->get('language'); ?>

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
    <form action="/task/new" method = "get">
      <h4 class = "col-lg-8"><?php echo Yii::t('msg/msg', 'Создать новую запись'); ?></h4>
      <div class="col-lg-8"><input class = "form-control" type="text" name = "title" /></div>
      <div class="col-lg-4">
        <button type = "submit" class = "btn btn-success form-control">
          <?php echo Yii::t('msg/msg', 'Создать'); ?>
        </button>
      </div>
    </form>
  </div>
</div>

<div class="task-container col-lg-8 col-lg-offset-2">
  <?php foreach ($data as $task){ ?>
  <?php $active = $task->status ? "active" : "non-active"; ?>
    <div class="row task <?php echo $active; ?>">
     <form action="/task/change" method = "get">
      <div class="col-lg-2 activate-task">
          <input class = "status" type="hidden" name = "status" value = "<?php echo $task->status; ?>">
          <button class = "btn btn-success form-control change-status"><span class = "glyphicon glyphicon-ok"></span></button>
      </div>
      <div class="col-lg-8 title">
        <h4 class = "text-center col-lg-8"><?php echo $task->title; ?></h4>
        <p class = "text-right"><?php echo $task->date; ?></p>
      </div>
      <div class="col-lg-8 change-title">
       
          <input type="hidden" name = "id" value = "<?php echo $task->id; ?>">
          <input class = "form-control" type="text" name = "title" value = "<?php echo $task->title; ?>">
          <button class="btn btn-success submit-change">
            <?php echo Yii::t('msg/msg', 'Подтвердить'); ?>
          </button>
          <button class="btn btn-danger cancel-change">
            <?php echo Yii::t('msg/msg', 'Отменить'); ?>
          </button>
        </form>
      </div>
      <div class="col-lg-2 text-right task-control">
        <button class="btn btn-info change-task">
          <span class="glyphicon glyphicon-edit"></span>
        </button>
        <form id = "delete-task" action="/task/delete" method = "get">
          <input type="hidden" name = "id" value = "<?php echo $task->id; ?>">
          <button class="btn btn-danger delete-task-button">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </form>
      </div>
      
        <?php foreach ($task->comment as $comment){ ?>
          <?php if ($task->status) {?>
          <div class="col-lg-8 comment-container">
            <div class = "bg-success comment ">
              <dir class="text-left col-lg-2">
              <form action="/task/delete-comment" method = "get">
                <input type="hidden" name = "id" value = "<?php echo $comment->id; ?>">
                  <button class="btn btn-danger">
                  <span class="glyphicon glyphicon-remove"></span>
                  </button>
              </form>
              </dir>
              <div class="date text-right"><?php echo $comment->date; ?></div>
              <p class = "col-lg-offset-1"><?php echo $comment->text; ?></p>
              
            </div>
          </div>
          <?php }?>
        <?php } ?>
      
      <div class="col-lg-8 new-comment" method = "get">
        <form action="/task/new-comment/">
          <label>Комментировать</label>
          <input type="hidden" name = "id" value = "<?php echo $task->id; ?>" />
          <textarea name="text" class = "form-control"></textarea>
          <button class = "btn btn-success">
            <?php echo Yii::t('msg/msg', 'Подтвердить'); ?>
          </button>
          
        </form>
      </div>
    </div>
    
  <?php } ?>
</div>