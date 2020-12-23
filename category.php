<?php require_once __DIR__. "/autoload/autoload.php";
    
	$id=intval(getInput('id'));
	$EditCategory=$db->fetchID('category',$id);
	if($id==7){
        $open='phukien';
    }
	if(isset($_GET['p'])){
        $p=$_GET['p'];
    }
    else{
        $p = 1;
    }
    $sql = " SELECT * FROM product WHERE category_id= $id ";
    $total=count($db->fetchsql($sql));
    $product=$db->fetchJones("product",$sql,$total,$p,8,true);
    if(isset($product['page'])){
      	$sotrang=$product['page'];
        unset($product['page']);
    }
    $path=$_SERVER['SCRIPT_NAME'];
?>
<?php require_once __DIR__. "/layouts/header.php";?>                 
                    <div class="col-md-9 col-xs-9" style="padding: 0px">
                        <img style="width:100%;height:auto" src="<?php echo base_url() ?>public/uploads/category/<?php echo $EditCategory['banner'] ?>" class="img-thumbnail">
                    </div> 
                    <div class="col-md-9 col-xs-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href="#"><?php echo $EditCategory['name'] ?></a> </h3>
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
					 		<li class="<?php echo isset($_GET['p']) && $_GET['p']==$i ? 'active' : '';?>"><a class="page-link" href="<?php echo $path ?>?id=<?php echo $id ?>&p=<?php echo $i ?>"><?php echo $i ?></a></li>
					 	<?php endfor ?> 
					 	</ul>
						</nav>

                        <!-- noi dung-->
                        </section>
                    </div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>               