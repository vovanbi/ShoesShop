<?php $open="transaction"; 
    require_once __DIR__. "/../../autoload/autoload.php";
    $id=intval(getInput('id'));
    $sql="SELECT orders.* ,product.name,product.thumbar FROM orders LEFT JOIN product ON orders.product_id=product.id WHERE orders.transaction_id = $id ORDER BY orders.id DESC";
    $order=$db->fetchsql($sql);
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>      


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Chi tiết đơn hàng
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="../../index.php">Bảng điều khiển</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-shopping-cart"></i><a href="index.php"> Đơn hàng</a> 
                            </li>
                            <li class="active">
                                <i class="fa fa-eye"></i><span> Chi tiết đơn hàng</span>
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
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>                
            </tr>
        </thead>
        <tbody>
            <?php $stt=1;foreach ($order as $item): ?>
            <tr>
                <td><?php echo $stt ?></td>
                <td><?php echo $item['name'] ?></td>
                <td><img width="80px" height="80px" src="<?php echo uploads()?>product/<?php echo $item['thumbar'] ;?>"/></td>
                <td><?php echo $item['qty'] ?></td>
                <td><?php echo formatPrice($item['price'])?></td>
            </tr>
            <?php $stt++;endforeach ?>
        </tbody>
            </table>
                <div class="pull-right">
                    <a class="btn btn-xs btn-danger" href="index.php"><i class="fa fa-undo-alt"></i> Quay lại</a>
                </div>
  
        </div>
                </div>
                <!-- /.row -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>

