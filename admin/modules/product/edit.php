 
<?php 
    $open="product";
    require_once __DIR__. "/../../autoload/autoload.php";
    //Lấy danh sách danh mục sản phẩm
    $category=$db->fetchAll('category');
    $id=intval(getInput('id'));
    $Editproduct=$db->fetchID('product',$id);
    if(empty($Editproduct)){
        $_SESSION['error']="Dữ liệu không tồn tại";
        redirectAdmin('product');
    }
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
            $update=$db->update('product',$data,array('id'=>$id));
            if($update>0){
                move_uploaded_file($file_tmp,$part.$file_name);
                $_SESSION['success']="Cập nhật thành công";
                redirectAdmin("product");
            }
            else{
                $_SESSION['error']="Cập nhật thất bại";
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
                            Chỉnh sửa sản phẩm
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="../../index.php">Bảng điều khiển</a>
                            </li>
                            <li>
                                <i class="fa fa-shopping-cart"></i>  <a href="index.php">Sản phẩm</a>
                            </li>
                            <li class="active">
                                <i class="fas fa-edit"></i> <span>Chỉnh sửa</span>
                            </li>
                        </ol>
                        <div class="clearfix">
                            <?php if(isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                            </div>
                        <?php endif; ?>
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
        <option value="<?php echo $item['id'] ?>" 
            <?php echo $Editproduct['category_id']==$item['id'] ? 'selected ="selected"' : '' ?>
            ><?php echo $item['name']?></option>
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
    <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?php echo $Editproduct['name']; ?>">
    <?php if (isset($error['name'])): ?> 
    <p class="text-danger"> <?php echo $error['name'] ?> </p>
    <?php endif ?> 
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Giá sản phẩm</label>
    <div class="col-sm-8">
    <input type="number" class="form-control" name="price" placeholder="9.000.000" value="<?php echo $Editproduct['price']; ?>">
    <?php if (isset($error['price'])): ?> 
    <p class="text-danger"> <?php echo $error['price'] ?> </p>
    <?php endif ?>  
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Số lượng sản phẩm</label>
    <div class="col-sm-8">
    <input type="number" class="form-control" name="number" placeholder="0" value="<?php echo $Editproduct['number']; ?>">
    <?php if (isset($error['number'])): ?> 
    <p class="text-danger"> <?php echo $error['number'] ?> </p>
    <?php endif ?>  
    </div>   
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Giảm giá</label>
    <div class="col-sm-3">
    <input type="number" class="form-control" name="sale" placeholder="10%" value="<?php echo $Editproduct['sale']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-lable">Hình ảnh</label>
    <div class="col-sm-3">
    <input type="file" class="form-control" name="thumbar">
    <?php if (isset($error['thumbar'])): ?> 
    <p class="text-danger"> <?php echo $error['thumbar'] ?> </p>
    <?php endif ?> 
    <img width="50px" height="50px" src="<?php echo uploads()?>product/<?php echo $Editproduct['thumbar'] ;?>"/>
    </div>
  </div>

   <div class="form-group">
    <label class="col-sm-2 control-lable">Nội dung</label>
    <div class="col-sm-8">
    <textarea class="form-control" name="content" rows="4"> <?php echo $Editproduct['content']; ?></textarea>
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

