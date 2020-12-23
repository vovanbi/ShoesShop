<?php $open="transaction"; 
      require_once __DIR__. "/../../autoload/autoload.php";
     
      $sql="SELECT transaction.* ,users.phone, users.name as nameuser FROM transaction LEFT JOIN users ON users.id=transaction.users_id ORDER BY ID DESC";
      $transaction=$db->fetchsql($sql);
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>      


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Danh sách đơn hàng
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="../../index.php">Bảng điều khiển</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-shopping-cart"></i><span> Đơn hàng</span> 
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                        <!--thong bao loi-->
                       <?php  require_once __DIR__. "/../../../partials/notification.php"; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">                                              
                        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                              <th class="th-sm">Stt

                              </th>
                              <th class="th-sm">Tên khách hàng

                              </th>
                              <th class="th-sm">Số điện thoại

                              </th>
                              <th class="th-sm">Tổng tiền(VND)

                              </th>
                              <th class="th-sm">Thanh toán

                              </th>
                              <th class="th-sm">Trạng thái

                              </th>
                              <th class="th-sm">Chức năng

                              </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt=1;foreach ($transaction as $item): ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['nameuser'] ?></td>
                                    <td><?php echo $item['phone'] ?></td>
                                    <td><?php echo formatPrice($item['amount'])?></td>
                                    <td>
                                      <span class="btn btn-xs <?php echo $item['type']==0 ? 'btn-success' : 'btn-info'?>"><?php echo $item['type']==0 ? 'Thường' : 'Online'?></span>
                                      <span><?php echo $item['vnp_BankCode']?></span>
                                      <span><?php echo $item['vnp_BankTranNo']?></span>                                
                                    </td>
                                    <td>
                                        <a href="status.php?id=<?php echo $item['id']?>" class="btn btn-xs <?php echo $item['status']==0 ? 'btn-danger' : 'btn-info'?>"><?php echo $item['status']==0 ? 'Chưa xử lý' : 'Đã xử lý'?></a>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i> Xóa</a>
                                        <a class="btn btn-xs btn-info" href="orderDetail.php?id=<?php echo $item['id'] ?>"><i class="fa fa-eye"></i> Chi tiết</a>
                                    </td>
                                </tr>
                            <?php $stt++;endforeach ?>                      
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>
<script>
  // Basic example
$(document).ready(function () {
  $('#dtBasicExample').DataTable({
    "pagingType": "simple_numbers" // "simple" option for 'Previous' and 'Next' buttons only
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>