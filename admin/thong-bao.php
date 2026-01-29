
<?php include('head.php');?>
<?php include('nav.php');?>

<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `thongbao` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","XÓA THÀNH CÔNG","success");setTimeout(function(){ location.href = "thong-bao.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "thong-bao.php" },1000);</script>'; 
    }
}
?>
<?php
    if (isset($_POST["submit"]))
    {
        

          $create = mysqli_query($ketnoi,"INSERT INTO `thongbao` SET 
            `title` = '".$_POST['title']."',
            `content` = '".$_POST['content']."',
            `createdate` = now()  ");
          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","THÊM THÀNH CÔNG","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
    }

?>


        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH THÔNG BÁO</h3>
               <div class="text-right">
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" class="btn btn-info">THÊM THÔNG BÁO</a>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-bordered table-striped">
                  <thead>                  
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">TITLE</th>
                      <th class="text-center">CONTENT</th>
                      <th class="text-center">TIME</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `thongbao` ORDER BY id desc ");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row['id'];?></td>
                      <td class="text-center"><?=$row['title'];?></td>
                      <td class="text-center"><?=$row['content'];?></td>
                      <td class="text-center"><?=$row['createdate'];?></td>
                      <td class="text-center">
                        <a href="thong-bao.php?delete=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fas fa-trash"></i> Delete
                        </a> 
                      </td>  
                    </tr>
<?php }?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->

<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">THÊM THÔNG BÁO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="post">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu Đề:</label>
                    <input type="text" class="form-control" name="title"  required="">
                  </div>  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nội Dung:</label>
                    <textarea class="textarea" name="content"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>      
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
              <button type="submit" name="submit" class="btn btn-primary">TẠO</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->        
<?php include('foot.php');?>