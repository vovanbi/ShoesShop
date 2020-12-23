<?php 
	session_start();		
	require_once __DIR__. "/../libraries/Function.php";
	require_once __DIR__. "/../libraries/Database.php";
    	$db=new Database;
    define("ROOT",$_SERVER['DOCUMENT_ROOT'] ."/ShoesShop/public/uploads/");
    $sqlHomecate="SELECT name,id FROM category WHERE home=1";
    $categoryhome=$db->fetchsql($sqlHomecate);
    /**
    lay danh sach san pham moi */
    $sqlNew="SELECT * FROM product WHERE 1 ORDER BY id DESC LIMIT 3";
    $productNew=$db->fetchsql($sqlNew);
    $sqlBuy="SELECT * FROM product WHERE 1 ORDER BY buy DESC LIMIT 3";
    $productBuy=$db->fetchsql($sqlBuy);

?>