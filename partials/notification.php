<?php if(isset($_SESSION['success'])) : ?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Thành Công!</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
</div>
<?php endif; ?>
<?php if(isset($_SESSION['error'])) : ?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Thất bại!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
</div>
<?php endif; ?>
