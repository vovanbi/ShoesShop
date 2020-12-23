<?php $open="rating"; 
      require_once __DIR__. "/../../autoload/autoload.php";
     
      if(isset($_GET['page'])){
        $p=$_GET['page'];
      }
      else{
        $p=1;
      }
      $sql="SELECT users.name,rating.*,product.thumbar,product.name as nameProduct FROM rating LEFT JOIN users ON rating.users_id = users.id LEFT JOIN product ON rating.product_id=product.id ORDER BY rating.id DESC";
      $rating=$db->fetchJone('rating',$sql,$p,8,true);
      if(isset($rating['page'])){
        $sotrang=$rating['page'];
        unset($rating['page']);
      }
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>      


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Danh sách đánh giá
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="../../index.php">Bảng điều khiển</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-comment"></i><span> Đánh giá</span>
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                        <!--thong bao loi-->
                       <?php  require_once __DIR__. "/../../../partials/notification.php"; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
            <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Stt</th>
                <th>Tên khách hàng</th>
                <th>Sản phẩm</th>
                <th>Nội dung</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt=1;foreach ($rating as $item): ?>
            <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $item['name'] ?></td>
                <td>
                    <img width="80px" height="80px" src="<?php echo uploads()?>product/<?php echo $item['thumbar'] ;?>"/>
                    <?php echo $item['nameProduct'] ?>
                </td>
                <td><?php echo $item['note'] ?></td>
                <td>
                    <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i>Xóa</a>
                </td>
            </tr>
            <?php $stt++;endforeach ?>
        </tbody>
            </table>
            <div class="pull-right">
                    <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                    for($i=1;$i<=$sotrang;$i++): 
                ?>
                <?php
                    if(isset($_GET['page'])){
                        $p=$_GET['page'];
                    }
                    else{
                        $p=1;
                    }
                ?>
                <li class="<?php echo($i==$p) ? 'active' : '' ?>">
                    <a href="?page=<?php echo $i ;?>"><?php echo $i ; ?></a>
                </li>
                <?php endfor;?>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        </div>

        </div>
                </div>
                <!-- /.row -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>

