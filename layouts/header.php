<?php require_once __DIR__. "/../autoload/autoload.php";?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shoes Shop: Chuyên các loại giày</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>public/frontend/images/logo.png">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/bootstrap.min.css">
        <!---->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/style1.css">

        <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url() ?>public/frontend/css/style.css"> -->
    </head>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <div id="header">
                <div id="header-top">                  
                    <div class="container">
                        <div class="clearfix">
                            <div class="col-md-12">
                                <nav id="header-nav-top">
                                    <ul class="list-inline pull-left" id="headermenu">
                                        <li id="info-left"><i class="fa fa-envelope"></i><a href="mailto:ShoesShop.UED@gmail.com">ShoesShop.UED@gmail.com</a></li>
                                        <li id="info-left"><i class="fa fa-phone"></i><a href="tel:+840528152815">0528152815</a></li>
                                    </ul>
                                    <ul class="list-inline pull-right" id="headermenu">                                       
                                        <?php if(isset($_SESSION['name_user'])): ?>
                                        <li style="color:#ffdd00">Xin chào: <?php echo $_SESSION['name_user']?></li>
                                        <li>
                                            <a href="thongtin.php?id=<?php echo $_SESSION['name_id']?>"><i class="fa fa-user"></i> Tài khoản <i class="fa fa-caret-down"></i></a>
                                            <ul id="header-submenu">
                                                <li><a href="thongtin.php?id=<?php echo $_SESSION['name_id']?>"><i class="fa fa-user"></i> Thông tin</a></li>
                                                <li><a href="giohang.php"><i class="fa fa-shopping-basket"></i> Giỏ hàng</a></li>
                                                <li><a href="checkout.php"><i class="fa fa-share-square-o"></i> Thoát</a></li>
                                            </ul>
                                        </li>
                                        <li>

                                        </li>
                                        <?php else : ?>
                                        <li>
                                            <a href="sign-in.php"><i class="fa fa-user"></i> Đăng nhập</a>
                                        </li>
                                        <li>
                                            <a href="sign-up.php"><i class="fa fa-bars"></i> Đăng ký</a>
                                        </li>
                                       <?php endif ?>
                                        
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END HEADER-->


            <!--MENUNAV-->
            <div id="menunav">
                <div class="container">
                    <nav>
                        <!--menu main-->
                        <ul id="menu-main">
                            <li class="<?php echo isset($open) && $open =='home' ? 'active' :''; ?>">
                                <a id="home-trangchu" href="index.php"><i id="fa-home" class="fa fa-home"></i> Trang chủ</a>
                            </li>
                            <li class="<?php echo isset($open) && $open =='phukien' ? 'active' :''; ?>">
                                <a href="category.php?id=7&&p=1">Phụ kiện</a>
                            </li>
                            <li class="<?php echo isset($open) && $open =='hotrokhachhang' ? 'active' :''; ?>">
                                <a href="hotrokhachhang.php">Hỗ trợ khách hàng</a>
                            </li>
                            <li class="<?php echo isset($open) && $open =='gioithieu' ? 'active' :''; ?>">
                                <a href="gioithieu.php">Giới thiệu</a>
                            </li>
                            <li class="<?php echo isset($open) && $open =='lienhe' ? 'active' :''; ?>">
                                <a href="lienhe.php">Liên hệ</a>
                            </li>                          
                        </ul>
                        <!-- end menu main-->

                        <!--Shopping-->
                        <ul class="" id="main-shopping">
                        	<li>
                                <form method="GET" action="index.php">
                                <div class="search">
                                    <input type="text" name="search" placeholder="Tìm sản phẩm, thương hiệu..." class="input_search" autocomplete="off">
                                    <button class="btn_search"><i id="button_search" class="fa fa-search"></i></button>
                                </div>
                                </form>
                            </li>
                            <li class="pull-right">
                                <a href="giohang.php"><i class="fa fa-shopping-basket"></i><span id="cart-qty" class="cart-quantity"><?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : '0'; ?></span> Giỏ hàng </a>
                            </li>
                        </ul>
                        <!--end Shopping-->
                    </nav>                  
                </div>

            </div>
            <!--ENDMENUNAV-->
            <div>
                <section id="slide" class="text-center" >
                     <!-- Banner-->
                </section>
            </div>
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3 col-xs-3 fixside" >
                        <div class="box-left box-menu" id="menuu">
                            <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
                            <?php foreach ($categoryhome as $item): ?>
				            <ul>
				            	<li class=""><a href="category.php?id=<?php echo $item['id']?>&p=1"><?php echo $item['name'] ?></a></li>
				            </ul>
				            <?php endforeach ?>
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                            <?php foreach ($productNew as $item): ?>  
                                <li class="clearfix">
                                    <a href="detail.php?id=<?php echo $item['id'] ?>">
                                        <img src="<?php echo uploads() ?>product/<?php echo $item['thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"><?php echo $item['name'] ?></p >
                                            <?php if($item['sale']>0): ?>
                                            <b class="price">Giá: <?php echo formatpriceSale($item['price'],$item['sale'])?></b><br>
                                            <b class="sale">Giá: <?php echo formatPrice($item['price'])?></b><br>
                                            <?php else:  ?>
                                            <b class="salee">Giá: <?php echo formatPrice($item['price'])?></b><br>
                                            <?php endif?>  
                                        </div>
                                    </a>
                                </li> 
                            <?php endforeach; ?>       
                            </ul>
                            <!-- </marquee> -->
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm bán chạy </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                
                                <?php foreach ($productBuy as $item): ?>  
                                <li class="clearfix">
                                    <a href="detail.php?id=<?php echo $item['id'] ?>">
                                        <img src="<?php echo uploads() ?>product/<?php echo $item['thumbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                        <div class="info pull-right">
                                            <p class="name"><?php echo $item['name'] ?></p >
                                            <?php if($item['sale']>0): ?>
                                            <b class="price">Giá: <?php echo formatpriceSale($item['price'],$item['sale'])?></b><br>
                                            <b class="sale">Giá: <?php echo formatPrice($item['price'])?></b><br>
                                            <?php else:  ?>
                                            <b class="sale">Giá: <?php echo formatPrice($item['price'])?></b><br>
                                            <?php endif?>  
                                        </div>
                                    </a>
                                </li> 
                                <?php endforeach; ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>