<?php
	require_once __DIR__. "/autoload/autoload.php";
    // if(!isset($_SESSION['name_id'])){
    //     echo "<script>alert(' Bạn phải đăng nhập mới thực hiện được chức năng này!'); location.href='index.php';</script>";
    // }
    $id=intval(getInput('id'));		
    //chi tiet san pham
    $product=$db->fetchID('product',$id);
    //kiem tra so luong trong kho, so sanh
    if($product['number']==0){
        $_SESSION['error']="Sản phẩm đã hết hàng!";
    }
    else if($_SESSION['cart'][$id]['qty']<$product['number']){
        if(!isset($_SESSION['cart'][$id])){
            //tao moi gio hang
            $_SESSION['cart'][$id]['name']=$product['name'];
            $_SESSION['cart'][$id]['thumbar']=$product['thumbar'];
            $_SESSION['cart'][$id]['number']=$product['number'];
            $_SESSION['cart'][$id]['qty']=1;
            $_SESSION['cart'][$id]['price']=$price=((100-$product['sale'])*$product['price'])/100;
            $_SESSION['cart'][$id]['size']=0;
        }
        else{
            $_SESSION['cart'][$id]['qty']+=1;           
        }
        $_SESSION['success']="Thêm sản phẩm thành công";  
    }
    else{
        $_SESSION['error']="Số lượng bạn mua vượt quá số lượng hàng có trong kho!";  
    }
    
    header('location:index.php');  
?>		