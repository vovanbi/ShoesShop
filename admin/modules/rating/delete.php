<?php 
	$open="rating";
	require_once __DIR__. "/../../autoload/autoload.php";
	$id=intval(getInput('id'));
	$EditRating=$db->fetchID('rating',$id);
	if(empty($EditRating)){
		$_SESSION['error']="Dữ liệu không tồn tại";
		redirectAdmin('rating');
	}
	$num=$db->delete('rating',$id);
	if($num>0){
		$_SESSION['success']="Xóa thành công";
		redirectAdmin('rating');
	}
	else{
		$_SESSION['success']="Xóa thất bại";
		redirectAdmin('rating');
	}
?>