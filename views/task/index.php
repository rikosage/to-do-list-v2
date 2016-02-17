<?php $this->title = 'Task'; ?>

<div class="row">
  <div class="add-container col-lg-8 col-lg-offset-2">
    <form action="/task/new" method = "post">
      <label>Введите название</label>
      <input class = "form-control" type="text" name = "title" />
      <label>Введите текст задания</label>
      <textarea class = "form-control" type="text" name = "text"></textarea>
      <button type = "submit" class = "btn btn-success">Создать</button>
    </form>
  </div>
</div>