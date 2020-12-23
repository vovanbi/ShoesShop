<?php require_once __DIR__. "/autoload/autoload.php";
    require_once"PHPMailer/PHPMailer.php";
    require_once"PHPMailer/Exception.php";
    require_once"PHPMailer/OAuth.php";
    require_once"PHPMailer/POP3.php";
    require_once"PHPMailer/SMTP.php";
    require_once"PHPMailer/sendMaill.php";
 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    //thanh toan online

    //tai khoan test
    // Ngân hàng: NCB
    // Số thẻ: 9704198526191432198
    // Tên chủ thẻ:NGUYEN VAN A
    // Ngày phát hành:07/15
    // Mật khẩu OTP:123456
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    /**
     * Description of vnpay_ajax
     *
     * @author xonv
     */
    $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
    $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost:81/ShoesShop/thanhtoan-online.php";

    $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = $_POST['note'];
    $vnp_OrderType = 1;
    $vnp_Amount = $_SESSION['total']*100;
    $vnp_Locale = $_POST['language'];
    $vnp_BankCode = $_POST['bank_code'];
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
        "vnp_Version" => "2.0.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . $key . "=" . $value;
        } else {
            $hashdata .= $key . "=" . $value;
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
       // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
        $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
        $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);

    //check dang nhap
    if(!isset($_SESSION['name_id'])){
        $_SESSION['login']= '';
        echo "<script>alert(' Bạn phải đăng nhập mới thực hiện được chức năng này!'); location.href='sign-in.php';</script>";
    }
    //check gio hang trong
    if(!isset($_SESSION['cart'])){
        echo "<script>alert(' Chưa có sản phẩm không thể thanh toán!');location.href='index.php';</script>";
    }

  //lay thong tin nguoi dung
	$user=$db->fetchID('users',intval($_SESSION['name_id']));

  //thanh toan sanbox
	if($_SERVER['REQUEST_METHOD']=='POST'){
    header('location: '.$returnData['data'].'');
  }
  //luu thong tin tra ve
  if(isset($_GET['vnp_Amount'])) {

      //insert data transation
      $data=[
        'amount'=> $_GET['vnp_Amount']/100,
        'users_id'=> $_SESSION['name_id'],
        'note'=> $_GET['vnp_OrderInfo'],
        'vnp_BankCode' => $_GET['vnp_BankCode'],
        'vnp_BankTranNo' => $_GET['vnp_BankTranNo'],
        'type'=>1,
      ];
      $idtran=$db->insert('transaction',$data);
      //insert data order
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
            $_SESSION['success']='Thanh toán đơn hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất!';
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
                               <td>Đã thanh toán <span>( Ngân hàng: '.$_GET['vnp_BankCode'].'; Mã giao dịch: '.$_GET['vnp_BankTranNo'].' )</span></td>
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
                </div>';
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'ShoesShop.UED@gmail.com';                 // SMTP username
                    $mail->Password = 'shoesshop123';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
                 
                    //Recipients
                    $mail->CharSet = "UTF-8";
                    $mail->setFrom('ShoesShop.UED@gmail.com','ShoesShop');
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
                                          <div class="col-md-12">
                                            <label for="order_id">Mã hóa đơn:</label>
                                            <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" readonly/>
                                          </div>
                                        </div>
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
                                              <div class="col-md-12">
                                              <label for="bank_code">Ngân hàng</label>
                                              <select name="bank_code" id="bank_code" class="form-control">
                                                  <option value="">Không chọn</option>
                                                  <option value="NCB"> Ngan hang NCB</option>
                                                  <option value="AGRIBANK"> Ngan hang Agribank</option>
                                                  <option value="SCB"> Ngan hang SCB</option>
                                                  <option value="SACOMBANK">Ngan hang SacomBank</option>
                                                  <option value="EXIMBANK"> Ngan hang EximBank</option>
                                                  <option value="MSBANK"> Ngan hang MSBANK</option>
                                                  <option value="NAMABANK"> Ngan hang NamABank</option>
                                                  <option value="VNMART"> Vi dien tu VnMart</option>
                                                  <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                                  <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                                  <option value="HDBANK">Ngan hang HDBank</option>
                                                  <option value="DONGABANK"> Ngan hang Dong A</option>
                                                  <option value="TPBANK"> Ngân hàng TPBank</option>
                                                  <option value="OJB"> Ngân hàng OceanBank</option>
                                                  <option value="BIDV"> Ngân hàng BIDV</option>
                                                  <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                                  <option value="VPBANK"> Ngan hang VPBank</option>
                                                  <option value="MBBANK"> Ngan hang MBBank</option>
                                                  <option value="ACB"> Ngan hang ACB</option>
                                                  <option value="OCB"> Ngan hang OCB</option>
                                                  <option value="IVB"> Ngan hang IVB</option>
                                                  <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <div class="col-md-12">
                                              <label for="language">Ngôn ngữ</label>
                                              <select name="language" id="language" class="form-control">
                                                  <option value="vn">Tiếng Việt</option>
                                                  <option value="en">English</option>
                                              </select>
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