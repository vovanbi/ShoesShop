<?php require_once __DIR__. "/autoload/autoload.php";
		$id=intval(getInput('id'));		
        $product=$db->fetchID('product',$id);
        $cateid=$product['category_id'];
        $sql="SELECT * FROM product WHERE category_id=$cateid ORDER BY id DESC LIMIT 4";
        $sanphamkemtheo=$db->fetchsql($sql);
        
        //add danh gia
        $error=[];
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!isset($_SESSION['name_id'])){
                echo "<script>alert(' Bạn phải đăng nhập mới thực hiện được chức năng này!'); location.replace();</script>";
            }
            else{
                $data=[
                        'note'=>postInput('note'),
                        'users_id' => $_SESSION['name_id'], 
                        'product_id' => $product['id']
                        ];
                if($data['note']==''){
                    $error['note']="Mời bạn nhập đánh giá";
                }
                if(empty($error)){
                    $insertRating=$db->insert('rating',$data);
                    if($insertRating>0){
                        $_SESSION['success']="Gửi đánh giá thành công";
                    }
                    else{
                        $_SESSION['error']="Gửi đánh giá thất bại";
                    }
                }
            }                
        }
        //view danh gia
        $sql="SELECT product.id,users.name,rating.* FROM product LEFT JOIN rating ON product.id = rating.product_id LEFT JOIN users ON rating.users_id = users.id WHERE product.id=$id ORDER BY rating.id DESC LIMIT 4";
        $viewDanhgia=$db->fetchsql($sql);       


?>
<?php require_once __DIR__. "/layouts/header.php";?>

                    <div class="col-md-9 col-xs-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href="">Chi tiết sản phẩm</a> </h3>                          
                            <!-- Thong bao -->
                            <?php  require_once __DIR__. "/partials/notification.php"; ?>
                            <div class="col-md-6 text-center">
                                <img src="<?php echo uploads() ?>product/<?php echo $product['thumbar'] ?>" class="img-responsive bor" id="imgmain" width="350px" height="350px" data-zoom-image="images/16-270x270.png">
                                
                                <!--<ul class="text-center bor clearfix" id="imgdetail">
                                    <li>
                                        <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                    <li>
                                        <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                    </li>
                                </ul>-->
                            </div>
                            <div class="col-md-6 bor" style="margin-top: 20px;">
                               <ul id="right">
                                    <li><h3> <?php echo $product['name']?></h3></li>
                                    <?php if($product['sale']>0): ?>
                                    <li>Giá: <p><strike class="sale"><?php echo formatPrice($product['price'])?></strike> <b class="price"><?php echo formatpriceSale($product['price'],$product['sale'])?></b></p></li>
                                    <?php else:  ?>
                                    <li><b>Giá: </b><b><?php echo formatPrice($product['price'])?></b></li>
                                    <?php endif ?>
                                    <li><b class="price"><a href="addcart.php?id=<?php echo $product['id'] ?>" class="btn btn-default"> <i class="fa fa-shopping-basket"></i>Thêm vào giỏ</a></b></li><b class="price">
                               </b></ul><b class="price">
                            </b></div><b class="price">

                        </b></section><b class="price">
                        <div class="col-md-12" id="tabdetail">
                            <div class="row">
                                    
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                                    <li><a data-toggle="tab" href="#menu1">Chính sách đổi trả </a></li>
                                    <li><a data-toggle="tab" href="#menu2">Hướng dẫn bảo quản</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <h3> Nội dung</h3>
                                        <p><?php echo $product['content'] ?></p>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <h3> Chính sách đổi trả </h3>
                                        <p>
                                            Quý Khách hàng cần kiểm tra tình trạng hàng hóa và có thể đổi hàng/ trả lại hàng ngay tại thời điểm giao/nhận hàng trong những trường hợp sau:<br/>
                                            -Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt hoặc như trên website tại thời điểm đặt hàng.<br/>
                                            -Không đủ số lượng, không đủ bộ như trong đơn hàng.<br/>
                                            -Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ… </p>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <h3> Hướng dẫn bảo quản</h3>
                                        <p> -Sử dụng nước dưới 35 độ để giặt sản phẩm<br/>
                                            -Không sử dụng thuốc tẩy hoặc bột giặt có độ tẩy cao<br/>
                                            -Sử dụng túi giặt bảo quản khi dùng với máy giặt<br/>
                                            -Tránh phơi dưới ánh nắng trực tiếp để bảo quản màu sắc</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 style="clear: left;" class="title-main"><a href="">Sản phẩm liên quan</a> </h3>
                            <div class="showitem">
                                <?php foreach ($sanphamkemtheo as $item): ?>
                                <div class="col-md-3 item-product bor">
                                    <a href="detail.php?id=<?php echo $item['id'] ?>">
                                        <img src="<?php echo uploads() ?>product/<?php echo $item['thumbar'] ?>" class="" width="100%" height="100%">
                                    </a>
                                    <div class="info-item">
                                        <a href="detail.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                                        <?php if($item['sale']>0): ?>
                                        <p>Giá: <strike class="sale"><?php echo formatPrice($item['price'])?></strike> <b class="price"><?php echo formatpriceSale($item['price'],$item['sale'])?></b></p>
                                        <?php else:  ?>
                                        <p>Giá: <b><?php echo formatPrice($item['price'])?></b></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="hidenitem">
                                        <p><a href="detail.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                        <p><a href=""><i class="fa fa-heart"></i></a></p>
                                        <p><a href=""><i class="fa fa-shopping-basket"></i></a></p>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>                      
                        </div>
                        <div class="col-md-12">
                            <h3 style="clear: left;" class="title-main"><a href="">Đánh giá sản phẩm</a> </h3>
                            <form method="post" action="">   
                                <div style="margin-top: 15px">
                                    <textarea style="resize: vertical;width: 100%" name="note" id="ra_content" cols="30" rows="5"></textarea>
                                </div>
                                <?php if(isset($error['note'])): ?>
                                    <p class="text-danger"><?php echo $error['note'] ?></p>
                                <?php endif ?>
                                <div style="margin: 15px 0">
                                    <button type="submit" name="submit" style="width: 120px;background: #288ad6;padding: 5px;color: white;border-radius: 5px;">Gửi đánh giá</button>
                                </div>     
                            </form>
                            <div class="component_list_rating">
                                <?php foreach ($viewDanhgia as $item): ?>
                                    <div class="rating_item">
                                        <div>
                                            <span style="color: #2ba832;font-weight: bold;text-transform: capitalize"><?php echo $item['name'] ?><?php if(isset($item['created_at'])): ?> <i style="color: #2ba832" class="fa fa-check-circle-o"></i><?php endif ?></span>
                                        </div>
                                        <p style="margin-bottom: 0">
                                            <span><?php echo $item['note'] ?></span>
                                        </p>
                                        <div>
                                            <span><?php if(isset($item['created_at'])): ?><i class="fa fa-clock-o"></i><?php endif ?> <?php echo $item['created_at'] ?></span>
                                        </div>
                                        <hr style="margin: 10px 0" />
                                    </div>
                                    
                                <?php endforeach ?>
                            </div>        
                        </div>
                    </b></div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>               