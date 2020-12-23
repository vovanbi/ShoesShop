<?php require_once __DIR__. "/autoload/autoload.php";
	
	$data=[
        'email'=>postInput('email'),
        'password'=>postInput('password'),
    ];

    $error=[];
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($data['email']==''){
            $error['email']="Email không được để trống";
        }
        if($data['password']==''){
            $error['password']="Mật khẩu không được để trống";
        }

        if(empty($error)){
        	$is_check=$db->fetchOne("users","email='".$data['email']."' AND password= '".md5($data['password'])."'");
        	if($is_check!= NULL){
        		$_SESSION['name_user']=$is_check['name'];
        		$_SESSION['name_id']=$is_check['id'];
                if(isset($_SESSION['login'])){
                    echo "<script>alert(' Đăng nhập thành công'); location.href='giohang.php';</script>";
                    unset($_SESSION['login']);
                }
        		echo "<script>alert(' Đăng nhập thành công'); location.href='index.php';</script>";
        	}
            $is_check=$db->fetchOne("users","email='".$data['email']."' AND password!= '".md5($data['password'])."'");
            if($is_check!= NULL){
                $error['password']="Mật khẩu không hợp lệ";
            }
            else{
                $error['email']="Email không tồn tại";
            }   
        }
    }        


?>
<?php require_once __DIR__. "/layouts/header.php";?>

                    <div class="col-md-9 col-xs-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href=""> Đăng nhập</a> </h3>
                            <!-- Thong bao -->
                            <?php  require_once __DIR__. "/partials/notification.php"; ?>
                        <!-- noi dung-->
                        	<form action="" method="POST" class="form-horizontal" role="form" style="margin-top: 20px">                      
                                <div class="form-group">
                                        <label style="font-size: 14px" class="col-md-2 col-md-offset-1" >Email</label>
                                        <div class="col-md-8">
                                            <input type="email" name="email" class="form-control" placeholder="ShoesShop.UED@gmail.com  ">
                                            <?php if(isset($error['email'])): ?>
                                                <p id="loi-email" class="text-danger"><?php echo $error['email'] ?></p>
                                            <?php endif ?>
                                        </div>                                  
                                </div>
                                <div class="form-group">
                                        <label style="font-size: 14px" class="col-md-2 col-md-offset-1" >Mật khẩu</label>
                                        <div class="col-md-8">
                                            <input type="password" name="password" class="form-control" placeholder="********">
                                            <?php if(isset($error['password'])): ?>
                                                <p class="text-danger"><?php echo $error['password'] ?></p>
                                            <?php endif ?>
                                        </div>                                  
                                </div>                             
                                <button style="margin: 10px 0px 10px 400px; font-size: 16px" class="btn btn-success col-md-2" >Đăng nhập</button>
                            </form>
                        </section>
                    </div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>               