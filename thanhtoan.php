<?php require_once __DIR__. "/autoload/autoload.php";
    require_once"PHPMailer/PHPMailer.php";
    require_once"PHPMailer/Exception.php";
    require_once"PHPMailer/OAuth.php";
    require_once"PHPMailer/POP3.php";
    require_once"PHPMailer/SMTP.php";
    require_once"PHPMailer/sendMaill.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
   
    if(!isset($_SESSION['name_id'])){
        $_SESSION['login']= '';
        echo "<script>alert(' Bạn phải đăng nhập mới thực hiện được chức năng này!'); location.href='sign-in.php';</script>";
    }
    if(!isset($_SESSION['cart'])){
        echo "<script>alert(' Chưa có sản phẩm không thể thanh toán!');location.href='index.php';</script>";
    }

	$user=$db->fetchID('users',intval($_SESSION['name_id']));

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$data=[
		    'amount'=> $_SESSION['total'],
		   	'users_id'=> $_SESSION['name_id'],
		    'note'=>postInput('note'),
	    ];

		$idtran=$db->insert('transaction',$data);
		if($idtran>0){
		  	foreach ($_SESSION['cart'] as $key => $value){
		  		$data2=[
		        'transaction_id'=> $idtran,
		    	  'product_id'=> $key,
		        'qty'=>$value['qty'],
		        'price'=>$value['price'],
            'size'=>$value['size'],
	        	];
	        	$id_insert=$db->insert('orders',$data2);
		  	}
		  	$_SESSION['success']='Lưu thông tin đơn hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất!';
		  	header('location: thongbao.php');

            //gui mail xac nhan don hang
            
            $html='
            <div style="border:8px solid #00b8e0;line-height:21px;padding:2px">
               &nbsp;
               <div style="padding:10px">
                  &nbsp;
                  <div><strong>Chào '.$user['name'].'!</strong></div>
                  <div>Cảm ơn Quý khách&nbsp;đã mua hàng của <a href="'.base_url().'" target="_blank">ShoesShop</a></div>
               </div>
               <div style="background:none repeat scroll 0 0 #00b8e0;color:#ffffff;font-weight:bold;line-height:25px;min-height:27px;padding-left:10px">Thông tin về đơn đặt hàng của Quý khách</div>
               <div style="padding:10px">
                  <div>Mã đơn hàng: <strong>'.$idtran.'</strong></div>
                  <table cellspacing="0" cellpadding="6" border="0" width="100%">
                     <tbody>
                        <tr>
                           <td width="173px">Tên người đặt hàng </td>
                           <td width="5px">:</td>
                           <td>'.$user['name'].'</td>
                        </tr>                      
                        <tr>
                           <td>Địa chỉ  </td>
                           <td width="5px">:</td>
                           <td>'.$user['address'].'</td>
                        </tr>
                        <tr>
                           <td>Email </td>
                           <td width="5px">:</td>
                           <td><a href="mailto:'.$user['email'].'" target="_blank">'.$user['email'].'</a></td>
                        </tr>
                        <tr>
                           <td>Điện thoại </td>
                           <td width="5px">:</td>
                           <td>'.$user['phone'].'</td>
                        </tr>
                        <tr>
                           <td>Thanh toán</td>
                           <td width="5px">:</td>
                           <td>Chưa thanh toán</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div style="background:none repeat scroll 0 0 #00b8e0;color:#ffffff;font-weight:bold;line-height:25px;min-height:27px;padding-left:10px">Chi tiết đơn hàng</div>
               <p>  </p>
               <table width="964" cellspacing="0" cellpadding="6" border="1" align="center" style="border-style:solid;border-collapse:collapse;margin-top:2px">
                  <thead style="background:#e7e7e7;line-height:12px">
                     <tr>
                        <th width="30">Stt</th>
                        <th>Tên sản phẩm</th>
                        <th width="117">Phân loại</th>
                        <th width="117">Giá</th>
                        <th width="117">Số lượng</th>
                        <th width="117">Tổng giá tiền</th>
                     </tr>
                  </thead>
                  <tbody>
                    '.$sendMaill.'
                     <tr>
                        <td colspan="5" align="right"><strong>Tổng:</strong></td>
                        <td><strong>'.formatPrice($_SESSION['total']).'</strong></td>
                     </tr>
                  </tbody>
               </table>
               <p></p>
               <div style="padding:10px">
                  <p><a href="'.base_url().'" target="_blank">ShoesShop</a>&nbsp;sẽ liên lạc với quý khách và xác nhận lại đơn hàng trong thời gian sớm nhất.<br>
                     Cảm ơn Quý Khách,
                  </p>
                  <p>&nbsp;</p>
               </div>
            </div>
            ';
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'shoesshop.ued@gmail.com';                 // SMTP username
                $mail->Password = 'shoesshop123';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
             
                //Recipients
                $mail->CharSet = "UTF-8";
                $mail->setFrom('shoesshop.ued@gmail.com','ShoesShop');
                $mail->addAddress($user['email']);     // Add a recipient
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');   
                
             
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
             
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Xác nhận đơn hàng';
                $mail->Body    = $html;     
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
             
                $mail->send();
                echo 'Message has been sent';
            } 
            catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
		}
	}   
?>
<?php require_once __DIR__. "/layouts/header.php";?>

                    <div class="col-md-9 col-xs-9 bor">
                        <section class="box-main1">
                            <h3 class="title-main"><a href=""> Thanh toán đơn hàng </a> </h3>
                        <!-- noi dung-->
                        <form action="" method="POST" class="form-horizontal" role="form" style="margin-top: 20px">                      
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <!--SHIPPING METHOD-->
                                  <div class="panel panel-info">
                                      <div class="panel-heading">Thông tin thanh toán</div>
                                      <div class="panel-body">                                        
                                          <div class="form-group">
                                              <div class="col-md-12"><strong>Họ Tên:</strong></div>
                                              <div class="col-md-12">
                                                  <input type="text" name="name" class="form-control" value="<?php echo $user['name'] ?>" readonly>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12"><strong>Địa chỉ:</strong></div>
                                              <div class="col-md-12">
                                                  <input type="text" name="address" class="form-control" value="491 Tôn Đức Thắng, Q.Liên Chiểu, TP.Đà Nẵng" readonly>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12"><strong>Email:</strong></div>
                                              <div class="col-md-12">
                                                  <input type="text" name="email" class="form-control" value="<?php echo $user['email'] ?>" readonly>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12"><strong>Số điện thoại:</strong></div>
                                              <div class="col-md-12">
                                                  <input type="text" name="phone" class="form-control" value="<?php echo $user['phone'] ?>" readonly>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12"><strong>Ghi chú:</strong></div>
                                              <div class="col-md-12">
                                                  <textarea style="max-width:   100%;padding-left: 5px" name="note" id="" cols="73" rows="4" class="fonm-control" placeholder="Giao hang tận nơi..." required=""></textarea>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12">
                                                  <button type="submit" class="btn btn-success">Xác nhận thông tin</button>
                                                  <a href="thanhtoan-online.php" class="btn btn-info">Thanh toán online</a>
                                              </div>
                                      </div>
                                  </div>
                                  <!--SHIPPING METHOD END-->
                                  <!--CREDIT CART PAYMENT-->
                                  <!--CREDIT CART PAYMENT END-->
                              </div>

                          
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <!--REVIEW ORDER-->
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        Danh sách sản phẩm <div class="pull-right"><small><a class="afix-1" href="giohang.php">Quay lại</a></small></div>
                                    </div>
                                    <div class="panel-body">
                                      <?php if(isset($_SESSION['cart'])):?>                                       
                                      <?php foreach ($_SESSION['cart'] as $key => $value): ?>
                                        <div class="form-group">
                                            <div class="col-sm-3 col-xs-3">
                                                <img class="img-responsive" style="width: 100px;height: 70px;" src="<?php echo uploads()?>product/<?php echo $value['thumbar'] ?>">
                                            </div>
                                            <div class="col-sm-6 col-xs-6" style="padding: 0px">
                                                <div class="col-xs-12" style="padding: 0px"><?php echo $value['name'] ?></div>
                                                <div class="col-xs-12" style="padding: 0px"><h6>Số lượng: <?php echo $value['qty'] ?></h6></div>
                                                <div class="col-xs-12" style="padding: 0px"><h6>Phân loại: <?php echo $value['size'] ?></h6></div>
                                            </div>
                                            <div class="col-sm-3 col-xs-3 text-right">
                                                <h6><?php echo formatPrice($value['price']*$value['qty']) ?></h6>
                                            </div>
                                        </div>
                                      <?php endforeach ;?>
                                      <?php endif ;?>
                                        <div class="form-group"><hr></div>
                                                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <strong>Tổng tiền</strong>
                                                <div class="pull-right"><span><?php echo formatPrice($_SESSION['total'])?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--REVIEW ORDER END-->
                            </div>
                            </form>
                        </section>
                    </div>
                    
<?php require_once __DIR__. "/layouts/footer.php";?>     
