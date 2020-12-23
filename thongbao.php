<?php require_once __DIR__. "/autoload/autoload.php";
	    unset($_SESSION['cart']);
	    unset($_SESSION['total']);
        unset($_SESSION['tongtien']);
?>
<?php require_once __DIR__. "/layouts/header.php";?>

                    <div class="col-md-9 col-xs-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href=""> Thông báo thanh toán </a> </h3>
                            <!-- Thong bao -->
                            <?php  require_once __DIR__. "/partials/notification.php"; ?>
                        <!-- noi dung--> 
                            <img style="width: 220px;height: 200px;margin-left: 200px;" src="<?php echo base_url() ?>public/frontend/images/thanks.png" class="img-thumbnail">
                        	<a href="index.php" class="btn btn-success">Trở về trang chủ</a>
                        </section>
                    </div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>               