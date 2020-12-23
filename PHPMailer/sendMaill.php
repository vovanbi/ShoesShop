<?php  
	$sendMaill='';
    $stt=1;
    foreach ($_SESSION['cart'] as $key => $value){
      $sendMaill.='
        <tr>
           <td align="center"><strong>'.$stt.'</strong><br></td>
           <td><a href="'.base_url().'detail.php?id='.$key.'" target="_blank">'.$value['name'].'</a></td>
           <td><strong>'.$value['size'].'</strong></td>
           <td><strong>'.formatPrice($value['price']).'</strong></td>
           <td><strong>'.$value['qty'].'</strong></td>
           <td><span>'.formatPrice($value['price']*$value['qty']).'</span></td>                      
        </tr>';
      $stt++;
    }
?>