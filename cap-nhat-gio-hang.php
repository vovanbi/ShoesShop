<?php require_once __DIR__. "/autoload/autoload.php";
		$key = intval(getInput('key'));	
		$qty = intval(getInput('qty'));	
		$size = intval(getInput('size'));	

		$_SESSION['cart'][$key]['qty']=$qty;
		$_SESSION['cart'][$key]['size']=$size;
		echo 1;
		$_SESSION['success']="Cập nhật giỏ hàng thành công";
?>