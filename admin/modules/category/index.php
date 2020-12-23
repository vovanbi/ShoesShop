<?php $open="category"; 
	  require_once __DIR__. "/../../autoload/autoload.php";
	  $category=$db->fetchAll('category');
      ?>
<?php require_once __DIR__. "/../../layouts/header.php"; ?>      


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Danh sách danh mục
                          <a href="add.php" class="btn btn-success">Thêm mới</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-tachometer-alt"></i>  <a href="../../index.php">Bảng điều khiển</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-list"></i><span> Danh mục</span> 
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
                              <th class="th-sm">Tên danh mục

                              </th>
                              <th class="th-sm">Hình ảnh

                              </th>
                              <th class="th-sm">Hiện trang chủ

                              </th>
                              <th class="th-sm">Chức năng

                              </th>
                            </tr>
                            </thead>
                            <tbody>
                            	<?php $stt=1;foreach ($category as $item): ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><img width="200px" height="70px" src="<?php echo uploads()?>category/<?php echo $item['banner'] ;?>"/></td>
                                    <td>
                                        <a href="home.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['home']==1 ? 'btn-info' :'btn-default'?> ">
                                            <?php echo $item['home']==1 ? 'Hiển thị' : 'Không' ?>
                                        </a>
                                    </td>                
                                    <td>
                                    	<a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id'] ?>"><i class="fa fa-edit"></i>Sửa</a>
                                    	<a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i>Xóa</a>
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

