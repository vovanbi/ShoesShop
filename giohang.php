<?php 
	require_once __DIR__. "/autoload/autoload.php";
      $sum=0;
      
      if(!isset($_SESSION['cart'])|| count($_SESSION['cart'])==0){
            echo "<script>alert(' Giỏ hàng trống!');</script>";
      }
      if(!isset($_SESSION['tongtien'])){
            $_SESSION['tongtien']=0;
      }

?>
<?php require_once __DIR__. "/layouts/header.php";?>

                    <div class="col-md-9 col-xs-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href="">Giỏ hàng của bạn</a> </h3>
                            <!-- Thong bao -->
                            <?php  require_once __DIR__. "/partials/notification.php"; ?>
                        <!-- noi dung-->     
                              <div style="overflow-x:scroll;">
                                    <table class="table title-hover">
                                          <thead>
                                                <tr>
                                                      <th>STT</th>
                                                      <th>Tên sản phẩm</th>
                                                      <th>Hình ảnh</th>
                                                      <th>Phân loại</th>
                                                      <th>Số lượng</th>
                                                      <th>Giá</th>
                                                      <th>Tổng tiền</th>
                                                      <th>Thao tác</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php if(isset($_SESSION['cart'])):?>                                       
                                                <?php $stt=1; foreach ($_SESSION['cart'] as $key => $value): ?>
                                                <tr>
                                                      <th><?php echo $stt ?></th>
                                                      <th><?php echo $value['name'] ?></th>
                                                      <th><img width="80px" height="80px" src="<?php echo uploads()?>product/<?php echo $value['thumbar'] ?>"></th>
                                                      <th>
                                                            <select class="form-control size" name="size" id="size" value="35">
                                                                  <option value="0">Không</option>                                                         
                                                                  <?php for($i=35;$i<=45;$i++):?>
                                                                        <option value="<?php echo $i ?>" <?php echo isset($value['size'])&& $value['size']==$i ? 'selected':''?> ><?php echo $i ?></option>
                                                                  <?php endfor ?>

                                                            </select>
                                                      </th>
                                                      <th><input type="number" name="qty" value="<?php echo $value['qty'] ?>" class="form-control qty" id="qty" min="1" max="<?php echo $value['number'] ?>"></th>
                                                      <th><?php echo formatPrice($value['price']) ?></th>
                                                      <th><?php echo formatPrice($value['price']*$value['qty']) ?></th>
                                                      <th>
                                                            <a class="btn btn-xs btn-info updatecart" href="" data-key=<?php echo $key ?>><i class="fa fa-refresh"></i> Cập nhật</a>
                                                            <a class="btn btn-xs btn-danger" href="remove.php?key=<?php echo $key ?>"><i class="fa fa-remove"></i> Xóa</a>
                                                      </th>
                                                </tr>
                                                <?php $sum += (($value['price']) * ($value['qty'])); $_SESSION['total'] = $sum ;?>
                                                <?php $stt ++;endforeach ;?>
                                                <?php endif ;?>

                                          </tbody>
                                    </table>
                                    <div class="col-md-5 pull-right">
                                          <ul class="list-group">
                                                <li class="list-group-item">
                                                      <h3> Thông tin đơn hàng </h3>
                                                </li>
                                                <li class="list-group-item">
                                                      <span class="badge"><?php echo isset($_SESSION['total']) ? formatPrice($_SESSION['total']) : '0 đ'?></span>                                   
                                                      Tổng tiền thanh toán
                                                </li>
                                                <li class="list-group-item">
                                                      <a class="btn btn-success" href="index.php">Tiếp tục mua hàng</a>
                                                      <a class="btn btn-success" href="thanhtoan.php">Thanh toán</a>
                                                </li>
                                          </ul>
                                    </div>
                              </div>                                                     
                        </section>
                    </div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>               