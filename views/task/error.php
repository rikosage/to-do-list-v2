<?php $this->title = "Error" ?>

<div class="container">
  <?php for ($i=0; $i < count($errors["text"]); $i++) { ?>
    <div class="error-container col-lg-12 bg-danger">
      <?php echo $errors["text"][$i]; ?>
    </div>
  <?php } ?>
  <?php for ($i=0; $i < count($errors["title"]); $i++) { ?>
    <div class="error-container col-lg-12 bg-danger">
      <?php echo $errors["title"][$i]; ?>
    </div>
  <?php } ?>
  <br>
  <br>
  <br>
  <a href="/" class="btn btn-success">Назад</a>
</div>