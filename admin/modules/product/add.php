 
<?php 
	$open="product";
	require_once __DIR__. "/../../autoload/autoload.php";
	//Lấy danh sách danh mục sản phẩm
	$category=$db->fetchAll('category');
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$data=
		[
			"name" => postInput('name'),
			"slug" => to_slug(postInput('name')),
			"category_id" => postInput('category_id'),
			"price" => postInput('price'),
            "number" => postInput('number'),
			"content" => postInput('content'),
            "sale" => postInput('sale'),
		];
		$error=[];
		if(postInput('name')==''){
			$error['name']='Mời bạn nhập đầy đủ tên sản phẩm';
		}
		if(postInput('category_id')==''){
			$error['category_id']='Mời bạn chọn danh mục sản phẩm';
		}
		if(postInput('price')==''){
			$error['price']='Mời bạn nhập đầy đủ giá sản phẩm';
		}
        if(postInput('number')==''){
            $error['number']='Mời bạn nhập đầy đủ số lượng sản phẩm';
        }
		if(postInput('content')==''){
			$error['content']='Mời bạn nhập đầy đủ nội dung sản phẩm';
		}
		if($_FILES['thumbar']['error']!=0){
            $error['thumbar']='Mời bạn chọn hình ảnh';
        }

        if(empty($error)){
        	if(isset($_FILES['thumbar'])){
        		$file_name=$_FILES['thumbar']['name'];
        		$file_tmp=$_FILES['thumbar']['tmp_name'];
        		$file_type=$_FILES['thumbar']['type'];
        		$file_error=$_FILES['thumbar']['error'];
        		if($file_error==0){
        			$part= ROOT ."product/";
        			$data['thumbar']=$file_name;
        		}
        	}
        	$id_insert = $db->insert("product" ,$data);
			if($id_insert>0){
                move_uploaded_file($file_tmp,$part.$file_name);
				$_SESSION['success']="Thêm mới thành công";
				redirectAdmin("product");
			}
			else{
			    $_SESSION['error']="Thêm mới thất bại";		
                redirectAdmin("product");		
			}
       
        }

	}
?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>      


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Thêm mới sản phẩm
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="../../index.php">Bảng điều khiển</a>
                            </li>
                            <li>
                                <i></i>  <a href="index.php">Sản phẩm</a>
                            </li>
                            <li class="active">
                                <i class="fas fa-plus-circle"></i> <span>Thêm mới</span>
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
    <label class="col-sm-2 control-lable">Danh mục sản phẩm</label>
    <div class="col-sm-8">
    <select class="form-control col-md-8" name="category_id">
    	<option>- Mời bạn chọn danh mục sản phẩm -</option>
    	<?php foreach ($category as $item):?> 
    	<option value="<?php echo $item['id'] ?>"><?php echo $item['name']?></option>
    	<?php endforeach ?>
    </select>
    <?php if (isset($error['category_id'])): ?> 
    <p class="text-danger"> <?php echo $error['category_id'] ?> </p>
    <?php endif ?> 
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Tên sản phẩm</label>
    <div class="col-sm-8">
    <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm">
    <?php if (isset($error['name'])): ?> 
    <p class="text-danger"> <?php echo $error['name'] ?> </p>
    <?php endif ?> 
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Giá sản phẩm</label>
    <div class="col-sm-8">
    <input type="number" class="form-control" name="price" placeholder="9.000.000">
    <?php if (isset($error['price'])): ?> 
    <p class="text-danger"> <?php echo $error['price'] ?> </p>
    <?php endif ?>  
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Số lượng sản phẩm</label>
    <div class="col-sm-8">
    <input type="number" class="form-control" name="number" placeholder="0" min="0">
    <?php if (isset($error['number'])): ?> 
    <p class="text-danger"> <?php echo $error['number'] ?> </p>
    <?php endif ?>  
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Giảm giá</label>
    <div class="col-sm-3">
    <input type="number" class="form-control" name="sale" placeholder="10%" value="0" min="0">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Hình ảnh</label>
    <div class="col-sm-3">
    <input type="file" class="form-control" name="thumbar">
    <?php if (isset($error['thumbar'])): ?> 
    <p class="text-danger"> <?php echo $error['thumbar'] ?> </p>
    <?php endif ?> 
    </div>
  </div>

   <div class="form-group">
    <label class="col-sm-2 control-lable">Nội dung</label>
    <div class="col-sm-8">
    <textarea class="form-control" name="content" rows="4">Hàng chất lượng cao</textarea>
    <?php if (isset($error['content'])): ?> 
    <p class="text-danger"> <?php echo $error['content'] ?> </p>
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

