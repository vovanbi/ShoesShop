<?php require_once __DIR__. "/autoload/autoload.php";
    $open="home"; 
    if(isset($_GET['p'])){
        $p=$_GET['p'];
    }
    else{
        $p = 1;
    }
    
    $sql = " SELECT category.home,product.* FROM product LEFT JOIN category ON product.category_id=category.id WHERE home=1 ORDER BY product.updated_at";
    $total=count($db->fetchsql($sql));
    $product=$db->fetchJones("product",$sql,$total,$p,12,true);
    if(isset($product['page'])){
        $sotrang=$product['page'];
        unset($product['page']);
    }
    
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $search = getInput('search');
        $sql = " SELECT category.home,product.* FROM product LEFT JOIN category ON product.category_id=category.id WHERE (home=1) AND (product.name LIKE '%$search%') ORDER BY product.updated_at";
        $total=count($db->fetchsql($sql));
        $product=$db->fetchJones("product",$sql,$total,$p,12,true);
        if(isset($product['page'])){
        $sotrang=$product['page'];
        unset($product['page']);
        }
        
    }
    else{
        echo "<script>alert(' Mời bạn nhập vào ô tìm kiếm'); location.href('index.php');</script>";
    }
    $path=$_SERVER['SCRIPT_NAME'];
?>


<?php require_once __DIR__. "/layouts/header.php";?>  
                          
                    <div class="col-md-9 col-xs-9" style="padding: 0px">
                        <img style="width:100%;height:auto" src="<?php echo base_url() ?>public/frontend/images/banner.jpg" class="img-thumbnail">
                    </div>       
                    <div class="col-md-9 col-xs-9 bor">                     
                        <section class="box-main1">
                            <h3 class="title-main"><a href="#"><?php echo isset($_GET["search"]) ? 'Tìm kiếm "'.$_GET["search"].'"' : 'Tất cả sản phẩm'?></a> </h3>
                            <!-- Thong bao -->
                            <?php  require_once __DIR__. "/partials/notification.php"; ?>
                        <!-- noi dung-->  
                        <div class="showitem clearfix">
                                <?php foreach ($product as $item): ?>
                                <div class="col-md-3 item-product bor">
                                    <a href="detail.php?id=<?php echo $item['id'] ?>">
                                        <img src="<?php echo uploads() ?>product/<?php echo $item['thumbar'] ?>" id="img-hover" width="100%" height="100%">
                                    </a>
                                    <div class="info-item">
                                        <a href="detail.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                                        <?php if($item['sale']>0): ?>
                                        <p>Giá: <strike class="sale"><?php echo formatPrice($item['price'])?></strike> <b class="price"><?php echo formatpriceSale($item['price'],$item['sale'])?></b></p>
                                        <?php else:  ?>
                                        <p class="salee">Giá: <b><?php echo formatPrice($item['price'])?></b></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="hidenitem">
                                        <p><a href="detail.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                        <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                                    </div>
                                </div>
                                <?php endforeach ?>      
                        </div>
                        <nav class="text-center">
                        <ul class="pagination">                         
                        <?php for ($i=1; $i<=$sotrang;$i++): ?>                       
                            <li class="<?php echo isset($_GET['p']) && $_GET['p']==$i ? 'active' : '';?>"><a class="page-link" href="<?php echo isset($_GET['search']) ? $path.'?search='.$_GET['search'].'&' : $path.'?'?>p=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php endfor ?> 
                        </ul>
                        </nav>

                        <!-- noi dung-->
                        </section>
                    </div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>              


