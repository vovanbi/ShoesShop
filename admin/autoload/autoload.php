<?php 
	session_start();		
	require_once __DIR__. "/../../libraries/Function.php";
	require_once __DIR__. "/../../libraries/Database.php";
    	$db=new Database;
    if(!isset($_SESSION['admin_id'])){
    	header("location:".base_url()."login/");
    }
    define("ROOT",$_SERVER['DOCUMENT_ROOT'] ."/ShoesShop/public/uploads/");
    $sqlBuy="SELECT * FROM product WHERE 1 ORDER BY buy DESC LIMIT 3";
    $productBuy=$db->fetchsql($sqlBuy);
?>