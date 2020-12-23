<?php require_once __DIR__. "/autoload/autoload.php";
    if(isset($_SESSION['name_id'])){
        echo "<script>alert(' Bạn đã có tài khoản!'); location.href='index.php';</script>";
    }
    
    //check mail ton tai
    $email = strtolower(postInput('email'));
    require('PHPMailer/inc/smtp-validate-email.php');
    $from = 'a-happy-camper@campspot.net';
    $validator = new SMTP_Validate_Email($email, $from);
    $smtp_results = $validator->validate();

    //xu li
    $data=[
        'name'=>postInput('name'),
        'email'=>postInput('email'),
        'password'=>postInput('password'),
        'phone'=>postInput('phone'),
        'address'=>postInput('address'),
    ];

    $error=[];
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($data['name']==''){
            $error['name']="Tên không được để trống";
        }
        if(isset($smtp_results[$email])&&$smtp_results[$email]==false) {
            $error['email']="Email không tồn tại";
        } 
        if($data['email']==''){
            $error['email']="Email không được để trống";
        }     
        else{
            $is_check=$db->fetchOne("users","email='".$data['email']."' ");
            if($is_check!=NULL){
                $error['email']="Email này đã được đăng ký";
            }
        }  
        if($data['password']==''){
            $error['password']="Mật khẩu không được để trống";
        }
        else{
            $data['password']=MD5(postInput('password')) ;   
        }
       
        if($data['phone']==''){
            $error['phone']="Số điện thoại không được để trống";
        }
        if($data['address']==''){
            $error['address']="Địa chỉ không được để trống";
        }
        //kiem tra mang error
        if(empty($error)){
            $IDinsert=$db->insert('users',$data);
            if($IDinsert>0){
                $_SESSION['success']="Đăng ký thành công! Mời bạn đăng nhập";
                header('location: sign-in.php');
            }
            else{
                echo 'Đăng ký thất bại';
            }

        }
    }	
?>
<?php require_once __DIR__. "/layouts/header.php";?>

                    <div class="col-md-9 col-xs-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href=""> Đăng ký thành viên </a> </h3>
                            <form action="" method="POST" class="form-horizontal" role="form" style="margin-top: 20px">                                                 
                            	<div class="form-group">
                                        <label style="font-size: 14px" class="col-md-2 col-md-offset-1" >Tên thành viên</label>
                                        <div class="col-md-8">
                                            <input type="text" name="name" class="form-control" placeholder="Shoes Shop" value="<?php echo $data['name'] ?>">
                                            <?php if(isset($error['name'])): ?>
                                                <p class="text-danger"><?php echo $error['name'] ?></p>
                                            <?php endif ?>
                                        </div>                         			
                            	</div>
                                <div class="form-group">
                                        <label style="font-size: 14px" class="col-md-2 col-md-offset-1" >Email</label>
                                        <div class="col-md-8">
                                            <input type="email" name="email" class="form-control" placeholder="ShoesShop.UED@gmail.com" value="<?php echo $data['email'] ?>">
                                            <?php if(isset($error['email'])): ?>
                                                <p class="text-danger"><?php echo $error['email'] ?></p>
                                            <?php endif ?>
                                        </div>                                  
                                </div>
                                <div class="form-group">
                                        <label style="font-size: 14px" class="col-md-2 col-md-offset-1">Mật khẩu</label>
                                        <div class="col-md-8">
                                            <input type="password" name="password" class="form-control" placeholder="********" value="<?php echo $data['password'] ?>">
                                            <?php if(isset($error['password'])): ?>
                                                <p class="text-danger"><?php echo $error['password'] ?></p>
                                            <?php endif ?>
                                        </div>                                  
                                </div>
                                <div class="form-group">
                                        <label style="font-size: 14px" class="col-md-2 col-md-offset-1" >Số điện thoại</label>
                                        <div class="col-md-8">
                                            <input type="number" name="phone" class="form-control" placeholder="0528152815" value="<?php echo $data['phone'] ?>">
                                            <?php if(isset($error['phone'])): ?>
                                                <p class="text-danger"><?php echo $error['phone'] ?></p>
                                            <?php endif ?>
                                        </div>                                  
                                </div>
                                <div class="form-group">
                                        <label style="font-size: 14px" class="col-md-2 col-md-offset-1" >Địa chỉ</label>
                                        <div class="col-md-8">
                                            <input type="text" name="address" class="form-control" placeholder="459 Tôn Đức Thắng, Q Liên Chiều,TP Đà Nẵng" value="<?php echo $data['address'] ?>">
                                            <?php if(isset($error['address'])): ?>
                                                <p class="text-danger"><?php echo $error['address'] ?></p>
                                            <?php endif ?>
                                        </div>                                  
                                </div>
                                <button style="margin: 10px 0px 10px 400px; font-size: 16px" class="btn btn-success col-md-2" >Đăng ký</button>
                            </form>

                        <!-- noi dung-->
                        </section>
                    </div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>                