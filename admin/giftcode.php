<?php include('head.php');?>
<?php include('nav.php');?>

<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `giftcode` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","XÓA THÀNH CÔNG","success");setTimeout(function(){ location.href = "giftcode.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "giftcode.php" },1000);</script>'; 
    }
}
?>
<?php
if ( isset($_POST["submit"]) && isset($_SESSION['admin']) )
{
    $code = check_string($_POST['code']);
    $soluong = check_string($_POST['soluong']);
    $money = check_string($_POST['money']);
    $dieukien = check_string($_POST['dieukien']);
    $query = $ketnoi->query("SELECT * FROM giftcode WHERE code = '$code' ");

    if($query->num_rows != 0)
    {
        echo '<script type="text/javascript">swal("Thất Bại", " Giftcode đã tồn tại !", "error");</script>';
    }
    else
    {
        $create = mysqli_query($ketnoi,"INSERT INTO `giftcode` SET 
        `code` = '".$code."',
        `soluong` = '".$soluong."',
        `money` = '".$money."',
        `dieukien` = '".$dieukien."',
        `createdate` =  now() ");
        if ($create)
        {
            echo '<script type="text/javascript">swal("THÀNH CÔNG","Tạo giftcode thành công!","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
        }
        else
        {
            echo '<script type="text/javascript">swal("THẤT BẠI","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
        }
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
                <h3 class="card-title">DANH SÁCH GIFTCODE</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">GIFTCODE</th>
                                <th class="text-center">ĐIỀU KIỆN</th>
                                <th class="text-center">SỐ LƯỢNG</th>
                                <th class="text-center">SỬ DỤNG</th>
                                <th class="text-center">SỐ TIỀN</th>
                                <th class="text-center">THỜI GIAN</th>
                                <th class="text-center">THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$i = 0;
$result = mysqli_query($ketnoi,"SELECT * FROM `giftcode` ORDER BY id desc");
while($row = mysqli_fetch_assoc($result))
{
?>
                            <tr>
                                <td class="text-center"><?=$i; $i++; ?></td>
                                <td class="text-center"><?=$row['code'];?></td>
                                <td class="text-center"><?=format_cash($row['dieukien']);?></td>
                                <td class="text-center"><?=$row['soluong'];?></td>
                                <td class="text-center"><?=$row['sudung'];?></td>
                                <td class="text-center"><?=format_cash($row['money']);?></td>
                                <td class="text-center"><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                <td class="text-center">
                                    <a href="giftcode.php?delete=<?=$row['id'];?>" class="btn btn-default">
                                        <i class="fas fa-trash"></i> XÓA
                                    </a>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default"
                    class="btn btn-info">TẠO GIFTCODE</a>
            </div>
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
                <h4 class="modal-title">TẠO GIFFTCODE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">GIFTCODE:</label>
                        <input type="text" class="form-control" name="code" placeholder="Nhập giftcode cần tạo"
                            required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ĐIỀU KIỆN TỔNG NẠP:</label>
                        <input type="number" class="form-control" name="dieukien" placeholder="Nhập tổng nạp để sử dụng giftcode"
                            required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SỐ LƯỢNG:</label>
                        <input type="number" class="form-control" name="soluong"
                            placeholder="Số lượng sử dụng cho mã giftcode" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SỐ TIỀN:</label>
                        <input type="number" class="form-control" name="money" placeholder="Số tiền nhận được"
                            required="">
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