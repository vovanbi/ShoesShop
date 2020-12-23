 
<?php require_once __DIR__. "/autoload/autoload.php";
    
    $sqlTransaction="SELECT transaction.* ,users.phone, users.name as nameuser FROM transaction LEFT JOIN users ON users.id=transaction.users_id ORDER BY ID DESC LIMIT 5";
    $transaction=$db->fetchsql($sqlTransaction);
    $sqlRating="SELECT users.name,rating.* FROM rating LEFT JOIN users ON rating.users_id = users.id ORDER BY rating.id DESC LIMIT 5";
    $rating=$db->fetchsql($sqlRating);

    $totalUser=$db->countTable('users');
    $totalRating=$db->countTable('rating');
    $totalTransaction=$db->countTable('transaction'); 

    //doanh thu
    $sqlNgay="SELECT sum(amount) as doanhthu FROM transaction WHERE DAY(updated_at) = DAY(NOW()) AND status = 1";
    $ngay=$db->total($sqlNgay);
    $sqlThang="SELECT sum(amount) as doanhthu FROM transaction WHERE MONTH(updated_at) = MONTH(NOW()) AND status = 1";
    $thang=$db->total($sqlThang);
?>
<?php require_once __DIR__. "/layouts/header.php"; ?>
    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Bảng điều khiển <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-tachometer-alt"></i> Bảng điều khiển
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $totalTransaction ?></div>
                                        <div>Đơn Hàng!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo modules('transaction') ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Chi Tiết</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $totalRating ?></div>
                                        <div>Đánh Giá!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo modules('rating') ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Chi Tiết</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $totalUser ?></div>
                                        <div>Thành Viên!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo modules('user') ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">Chi Tiết</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>                   
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Hỗ Trợ Khách Hàng!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="https://dashboard.tawk.to/#/chat" target="_blank">
                                <div class="panel-footer">
                                    <span class="pull-left">Chi Tiết</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Thống kê doanh thu</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ngày/Tháng</th>
                                                <th>Tổng tiền (VND)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Ngày</td>
                                                <td><?php echo formatPrice($ngay['doanhthu'])?></td>
                                            </tr>
                                            <tr>
                                                <td>Tháng</td>
                                                <td><?php echo formatPrice($thang['doanhthu'])?></td>
                                            </tr>                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-warning fa-fw"></i> Sản phẩm bán chạy</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Stt</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Hình ảnh</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $stt=1; foreach ($productBuy as $item): ?>
                                            <tr>
                                                <td><?php echo $stt ?></td>
                                                <td><?php echo $item['name'] ?></td>
                                                <td>
                                                    <img src="<?php echo uploads() ?>product/<?php echo $item['thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                                </td>
                                                <td>
                                                    <?php if($item['sale']>0): ?>
                                                    <b class="price" style="color: #ea3a3c;">Giá: <?php echo formatpriceSale($item['price'],$item['sale'])?></b><br>
                                                    <b class="sale" style="text-decoration: line-through;">Giá: <?php echo formatPrice($item['price'])?></b><br>
                                                    <?php else:  ?>
                                                    <b class="salee">Giá: <?php echo formatPrice($item['price'])?></b><br>
                                                    <?php endif?>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>Đã bán: <?php echo $item['buy'] ?></li>
                                                        <li>Còn lại: <?php echo $item['number'] ?></li>
                                                    </ul>
                                                </td>
                                            </tr>  
                                            <?php $stt++; endforeach ?>                                  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Thống kê đơn hàng</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Stt #</th>
                                                <th>Thời gian</th>
                                                <th>Tên khách hàng</th>
                                                <th>Tổng tiền (VND)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $stt=1; foreach ($transaction as $item): ?>
                                            <tr>
                                                <td><?php echo $stt ?></td>
                                                <td><?php echo $item['created_at'] ?></td>
                                                <td><?php echo $item['nameuser'] ?></td>
                                                <td><?php echo formatPrice($item['amount']) ?></td>
                                            </tr>  
                                            <?php $stt++; endforeach ?>                                      
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="<?php echo modules('transaction') ?>">Chi Tiết <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Thống kê đánh giá</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Stt #</th>
                                                <th>Thời gian</th>
                                                <th>Tên khách hàng</th>
                                                <th>Nội dung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $stt=1; foreach ($rating as $item): ?>
                                            <tr>
                                                <td><?php echo $stt ?></td>
                                                <td><?php echo $item['created_at'] ?></td>
                                                <td><?php echo $item['name'] ?></td>
                                                <td><?php echo $item['note'] ?></td>
                                            </tr>  
                                            <?php $stt++; endforeach ?>                                      
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="<?php echo modules('rating') ?>">Chi Tiêt <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
<?php require_once __DIR__. "/layouts/footer.php"; ?>

