 
<?php 
    $open="admin";
    require_once __DIR__. "/../../autoload/autoload.php";

    $id=intval(getInput('id'));
    $Editadmin=$db->fetchID('admin',$id);
    if(empty($Editadmin)){
        $_SESSION['error']="Dữ liệu không tồn tại";
        redirectAdmin('admin');
    }
    //Lấy danh sách danh mục sản phẩm
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $data=
        [
            "name" => postInput('name'),
            "email" => postInput('email'),
            "phone" => postInput('phone'),
            "address" => postInput('address'),
            "password" => MD5(postInput('password')),
        ];

        $error=[];
        if(postInput('name')==''){
            $error['name']='Mời bạn nhập đầy đủ họ tên';
        }
        if(postInput('email')==''){
            $error['email']='Mời bạn nhập đầy đủ email';
        }
        else{
            if(postInput('email') != $Editadmin['email']){
	            $is_check=$db->fetchOne("admin","email= '".$data['email']."' ");
	            if($is_check!=NULL){
	                $error['email']='Email đã tồn tại';
	            }
	        }   
        }
        if(postInput('phone')==''){
            $error['phone']='Mời bạn nhập đầy đủ số điện thoại';
        }
        if(postInput('address')==''){
            $error['address']='Mời bạn nhập đầy đủ địa chỉ';
        }
        if(postInput('password')==''){
            $error['password']='Mời bạn nhập đầy đủ mật khẩu';
        }
        if(postInput('re_password')==''){
            $error['re_password']='Mời bạn nhập đầy đủ mật khẩu';
        }
        if($data['password']!= MD5(postInput('re_password'))){
            $error['re_password']='Mật khẩu không khớp';
        }
    



        if(empty($error)){
            $id_update = $db->update("admin" ,$data,array("id"=>$id));
            if($id_update>0){
                $_SESSION['success']="Cập nhật thành công";
                redirectAdmin("admin");
            }
            else{
                $_SESSION['error']="Cập nhật thất bại";     
                redirectAdmin("admin");       
            }
       
    }

    }
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>      


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Chỉnh sửa quản lý
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="index.html">Bảng điều khiển</a>
                            </li>
                            <li>
                                <i class="fa fa-user"></i>  <a href="index.php">Quản lý</a>
                            </li>
                            <li class="active">
                                <i class="fas fa-edit"></i> <span>Chỉnh sửa</span> 
                            </li>
                        </ol>
                        <div class="clearfix">
                            <!--thong bao loi-->
                       <?php  require_once __DIR__. "/../../../partials/notification.php"; ?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-8" >
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label class="col-sm-2 control-lable">Họ và tên</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="name" placeholder="Nguyễn Văn A" value="<?php echo $Editadmin['name'] ?>">
    <?php if (isset($error['name'])): ?> 
    <p class="text-danger"> <?php echo $error['name'] ?> </p>
    <?php endif ?> 
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Email</label>
    <div class="col-sm-8">
    <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $Editadmin['email'] ?>">
    <?php if (isset($error['email'])): ?> 
    <p class="text-danger"> <?php echo $error['email'] ?> </p>
    <?php endif ?>  
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Số điện thoại</label>
    <div class="col-sm-8">
    <input type="number" class="form-control" name="phone" placeholder="" value="<?php echo $Editadmin['phone'] ?>">
    <?php if (isset($error['phone'])): ?> 
    <p class="text-danger"> <?php echo $error['phone'] ?> </p>
    <?php endif ?>  
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Mật khẩu mới</label>
    <div class="col-sm-8">
    <input type="password" class="form-control" name="password" placeholder="********">
    <?php if (isset($error['password'])): ?> 
    <p class="text-danger"> <?php echo $error['password'] ?> </p>
    <?php endif ?> 
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Nhập lại mật khẩu</label>
    <div class="col-sm-8">
    <input type="password" class="form-control" name="re_password" placeholder="********" value="">
    <?php if (isset($error['re_password'])): ?> 
    <p class="text-danger"> <?php echo $error['re_password'] ?> </p>
    <?php endif ?> 
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Địa chỉ</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="address" placeholder="" value="<?php echo $Editadmin['address'] ?>">
    <?php if (isset($error['address'])): ?> 
    <p class="text-danger"> <?php echo $error['address'] ?> </p>
    <?php endif ?> 
    </div>
  </div>

  <div class="form-group form-check">
  </div>
  <button type="submit" class="btn btn-success">Lưu</button>
</form>
                </div>
                </div>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>

