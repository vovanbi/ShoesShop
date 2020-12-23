                </div>
                <div class="container-pluid">
                <section id="footer">
                    <div class="container">
                        <div class="col-md-3" id="shareicon">
                            <ul>
                                <li>
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8" id="title-block">
                            <div class="pull-left">
                                
                            </div>
                            <div class="pull-right">
                                
                            </div>
                        </div>
                       
                    </div>
                </section>
                <section id="footer-button">
                    <div class="container-pluid">
                        <div class="container">
                            <div class="col-md-3" id="ft-about">
                                
                                <p> Cảm ơn bạn đã ghé qua. Mọi chi tiết xin liên hệ với chúng tôi! </p>
                            </div>
                            <div class="col-md-3 box-footer" >
                                <h3 class="tittle-footer">hỗ trợ khách hàng</h3>
                                <ul>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="hotrokhachhang.php"><i></i> Đặt hàng & Thanh toán</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="hotrokhachhang.php"><i></i> Giao hàng & Nhận hàng </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="hotrokhachhang.php"><i></i> Chính sách bảo mật</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="hotrokhachhang.php"><i></i> Điều khoản dịch vụ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 box-footer">
                                <h3 class="tittle-footer">về chúng tôi</h3>
                               <ul>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="gioithieu.php"><i></i> Giới thiệu</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="gioithieu.php"><i></i>  Câu hỏi thường gặp </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href="lienhe.php"><i></i> Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 box-footer" id="footer-support">
                                <h3 class="tittle-footer"> Liên hệ</h3>
                                <ul>
                                    <li>
                                        <p><i class="fa fa-home" style="font-size: 16px;padding-right: 5px;"></i> 459 Tôn Đức Thắng, Hoà Khánh Nam, Liên Chiểu, Đà Nẵng, Việt Nam </p>
                                        <p><i class="sp-ic fa fa-mobile" style="font-size: 20px;padding-right: 7px;"></i> 0528152815</p>
                                        <p><i class="sp-ic fa fa-envelope" style="padding-right: 5px;"></i> ShoesShop.UED@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="ft-bottom">
                    <p class="text-center">Copyright © 2020 . Design by me !!! </p>
                </section>
            </div>
        </div>      
    </div>
            </div>      
        </div>
    
</body>
        
</html>
<script  src="<?php echo base_url() ?>public/frontend/js/jquery-3.2.1.min.js"></script>
<script  src="<?php echo base_url() ?>public/frontend/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function() {
        $hidenitem = $(".hidenitem");
        $itemproduct = $(".item-product");
        $itemproduct.hover(function(){
            $(this).children(".hidenitem").show(100);
        },function(){
            $hidenitem.hide(500);
        })
    })
</script>
<script type="text/javascript">
     $(function(){
        $updatecart = $(".updatecart");
        $updatecart.click(function(e) {
            e.preventDefault();
            $qty = $(this).parents("tr").find(".qty").val();
            $size = $(this).parents("tr").find(".size").val();

            $key = $(this).attr("data-key");

            console.log($key);
            $.ajax({
                url: 'cap-nhat-gio-hang.php',
                type: 'GET',
                data: {'qty': $qty,'size':$size, 'key':$key},
                success:function(data)
                {
                    if (data == 1) 
                    {
                        alert('Bạn đã cập nhật giỏ hàng thành công!');
                        location.href='giohang.php';
                    }
                    else
                    {
                        alert('Xin lỗi! Số lượng bạn mua vượt quá số lượng hàng có trong kho!');
                        location.href='giohang.php';
                    }
                }
            });
            
        })
    }) 
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fc31fbb920fc91564cba4fa/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->