  
<?php 
	$open="category";
	require_once __DIR__. "/../../autoload/autoload.php";
	$id=intval(getInput('id'));
	$EditCategory=$db->fetchID('category',$id);
	if(empty($EditCategory)){
		$_SESSION['error']="Dữ liệu không tồn tại";
		redirectAdmin('category');
	}
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$data=
		[
			"name" => postInput('name'),
			"slug" => to_slug(postInput('name')),
		];
		$error=[];
		if(postInput('name')==''){
            $error['name']='Mời bạn nhập đầy đủ danh mục sản phẩm';
        }
        if($_FILES['banner']['error']!=0){
            $error['banner']='Mời bạn chọn hình ảnh';
        }
        
		if(empty($error)){
            if(isset($_FILES['banner'])){
                $file_name=$_FILES['banner']['name'];
                $file_tmp=$_FILES['banner']['tmp_name'];
                $file_type=$_FILES['banner']['type'];
                $file_error=$_FILES['banner']['error'];
                if($file_error==0){
                    $part= ROOT ."category/";
                    $data['banner']=$file_name;
                }
            }
			$id_update = $db->update("category" ,$data,array('id'=>$id));
			if($id_update>0){
				$_SESSION['success']="Cập nhật thành công";
				redirectAdmin("category");
			}
			else{
			$_SESSION['error']="Dữ liệu không thay đổi";	
                redirectAdmin("category");			
			}
		}

	}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>      


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Chỉnh sửa danh mục
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="../../index.php">Bảng điều khiển</a>
                            </li>
                            <li>
                                <i></i>  <a href="index.php">Danh mục</a>
                            </li>
                            <li class="active">
                                <i class="fas fa-edit"></i> <span>Chỉnh sửa</span>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-8" >
                	<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Tên danh mục</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" placeholder="Tên danh mục" value="<?php echo $EditCategory['name'] ?>">
                            <?php if (isset($error['name'])): ?> 
                            <p class="text-danger"> <?php echo $error['name'] ?> </p>
                            <?php endif ?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-lable">Hình ảnh</label>
                            <div class="col-sm-3">
                            <input type="file" class="form-control" name="banner">
                            <?php if (isset($error['banner'])): ?> 
                            <p class="text-danger"> <?php echo $error['banner'] ?> </p>
                            <?php endif ?> 
                            <img width="170px" height="50px" src="<?php echo uploads()?>category/<?php echo $EditCategory['banner'] ;?>"/>
                            </div>
                        </div>
                        <div class="form-group form-check">
                        </div>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </form>
                </div>
            	</div>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>

