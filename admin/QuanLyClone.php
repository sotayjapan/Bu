
<?php include('head.php');?>
<?php include('nav.php');?>
<?php die();?>
<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = $ketnoi->query("DELETE FROM `taikhoan` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","Xóa thành công","success");setTimeout(function(){ location.href = "quan-ly-clone.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Thất Bại","Lỗi máy chủ","error");setTimeout(function(){ location.href = "quan-ly-clone.php" },1000);</script>'; 
    }
}
if (isset($_POST["CheckInfo"]))
{
  $check_token = $ketnoi->query("SELECT site_token FROM setting")->fetch_array()["site_token"];

  if ($check_token == '')
  {
    echo '<script type="text/javascript">swal("Thất Bại","Bạn chưa thêm Token vào hệ thống !","error");</script>'; 
  }
  else
  {

    $result1 = $ketnoi->query("SELECT * FROM `category` WHERE `pin` = 'facebook' ORDER BY id   ");
    while ($data = mysqli_fetch_array($result1)) 
    {
      $result = $ketnoi->query("SELECT * FROM `taikhoan` WHERE `username` IS NULL AND `status` = 'live' AND `code` = '".$data['code']."' ORDER BY id   ");
      while ($row = mysqli_fetch_array($result)) 
      {
        $check_json_live = json_decode(curl_get("https://graph.facebook.com/".$row['id_fb']."/picture?redirect=false"), true);
        if(isset($check_json_live['data']['width']))
        {

          $json_get_info = json_decode(curl_get("https://graph.facebook.com/".$row['id_fb']."?fields=gender,friends,updated_time,name&access_token=".$site_token), true);
          $ketnoi->query("UPDATE `taikhoan` SET 
            `gender` = '".$json_get_info['gender']."',
            `friends` = '".count($json_get_info['friends']['data'])."',
            `name` = '".$json_get_info['name']."',
            `updated_time` = '".$json_get_info['updated_time']."'
             WHERE `id` = '".$row['id']."' ");
        }
        else if(empty($check_json_live['data']['width']))
        {
          $ketnoi->query("UPDATE `taikhoan` SET `status` = 'die' WHERE `id` = '".$row['id']."' ");
        }
      }
    }
    echo '<script type="text/javascript">swal("Thành Công","Cập nhật thông tin thành công!","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
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
                <h3 class="card-title">DANH SÁCH CLONE - VIA</h3>
                <div class="text-right">
                  <form method="post" action="">
                  <button class="btn btn-info" type="submit" name="CheckInfo">Cập Nhật Thông Tin</a>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>                  
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">NHÓM</th>
                      <th class="text-center">AVT</th>
                      <th class="text-center">NAME</th>
                      <th class="text-center">ID</th>
                      <th class="text-center">PASS</th>
                      <th class="text-center">2FA</th>
                      <th class="text-center">GENDER</th>
                      <th class="text-center">FRIENDS</th>
                      <th class="text-center">HOẠT ĐỘNG LẦN CUỐI</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">OWNER</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `taikhoan` WHERE `username` is NULL ORDER BY id desc");
while($row = mysqli_fetch_assoc($result))
{
  $get_string_clone = explode("|", $row['note']);
  $check111 = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `title` FROM `category` WHERE `code` = '".$row['code']."'  ")) ['title'];
?>
                    <tr>
                        <td class="text-center"><?=$row['id'];?></td>
                      <td class="text-center"><?=$ketnoi->query("SELECT `title` FROM `category` WHERE `code` = '".$row['code']."' ")->fetch_array()['title'];?></td>
                      <td class="text-center"><img src="//graph.facebook.com/<?=$row['id_fb'];?>/picture"></td>
                      <td class="text-center"><?=$row['name'];?></td>
                      <td class="text-center"><a href="https://www.facebook.com/<?=$row['id_fb'];?>" target="_blank"><?=$get_string_clone[0];?></a></td>
                      <td class="text-center"><?=$get_string_clone[1];?></td>
                      <td class="text-center"><?=$get_string_clone[2];?></td>
                      <td class="text-center"><?php if ($row['gender'] == 'male'){ echo "Nam";} if ($row['gender'] == 'female') { echo "Nữ";};?></td>
                      <td class="text-center"><?=format_cash($row['friends']);?></td>
                      <td class="text-center"><?=$row['updated_time'];?></td>
                      <td class="text-center">
                        <?php
                          if ($row['status'] == 'die')
                          {
                            echo '<span class="badge bg-danger">DIE</span>';
                          }
                          if ($row['status'] == 'live')
                          {
                            echo '<span class="badge bg-success">LIVE</span>';
                          }
                        ?>
                        </td>
                      <td class="text-center">
                        <?php
                          if ($row['username'] != '')
                          {
                            echo '<span class="badge bg-danger">ĐÃ BÁN</span>';
                          }
                          if ($row['username'] == '')
                          {
                            echo '<span class="badge bg-success">ĐANG BÁN</span>';
                          }
                        ?>
                      </td>
                      <td class="text-center">
                        <a href="quan-ly-clone.php?delete=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fas fa-trash"></i>
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
                VUI LÒNG THAO TÁC CẨN THẬN
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->




<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>

<?php include('foot.php');?>