<?php

$total_ticket_dang_xu_ly = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `ticket` WHERE `status` = 'xuly' ")) ['COUNT(*)'];
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/home/" class="nav-link">HOME</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="https://www.facebook.com/ntgtanetwork" class="nav-link">LIÊN HỆ KỸ THUẬT</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <span class="brand-text font-weight-light">QUẢN TRỊ WEBSITE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="index.php" class="nav-link active">
                        <p>
                            HOME
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="order.php" class="nav-link">
                                <p><i class="nav-icon fa fa-book" aria-hidden="true"></i> ĐƠN HÀNG</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="thanh-vien.php" class="nav-link">
                                <p><i class="nav-icon fas fa-user-friends"></i> THÀNH VIÊN</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ho-tro.php" class="nav-link">
                                <p><i class="nav-icon fa fa-envelope-open"></i> HỖ TRỢ <span
                                        class="badge badge-danger"><?=$total_ticket_dang_xu_ly;?></span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="nap-the.php" class="nav-link">
                                <p><i class="nav-icon fa fa-credit-card"></i> NẠP THẺ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="momo.php" class="nav-link">
                                <p><i class="nav-icon fa fa-credit-card"></i> MOMO</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="bank-auto.php" class="nav-link">
                                <p><i class="nav-icon fa fa-credit-card"></i> BANK AUTO</p>
                            </a>
                        </li>
                        <!--<li class="nav-item">
                <a href="QuanLyClone.php" class="nav-link">
                  <p><i class="nav-icon fa fa-book" aria-hidden="true"></i> QUẢN LÝ CLONE - VIA</p>
                </a>
              </li>-->
                        <li class="nav-item">
                            <a href="#" data-toggle="modal" data-target="#modalDownBackupVia" class="nav-link">
                                <p><i class="nav-icon fa fa-book" aria-hidden="true"></i> UPFILE BACKUP</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tai-khoan.php" class="nav-link">
                                <p><i class="nav-icon fa fa-book" aria-hidden="true"></i> TÀI KHOẢN</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="giftcode.php" class="nav-link">
                                <p><i class="nav-icon fa fa-gift" aria-hidden="true"></i> GIFTCODE</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="chuyen-muc.php" class="nav-link">
                                <p><i class="nav-icon fa fa-tag" aria-hidden="true"></i> THỂ LOẠI</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="bank.php" class="nav-link">
                                <p><i class="nav-icon fa fa-university" aria-hidden="true"></i> NGÂN HÀNG</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="thong-bao.php" class="nav-link">
                                <p><i class="nav-icon fa fa-envelope-open" aria-hidden="true"></i> THÔNG BÁO</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="CauHinhText.php" class="nav-link">
                                <p><i class="nav-icon fa fa-language" aria-hidden="true"></i> CẤU HÌNH NGÔN NGỮ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="cai-dat.php" class="nav-link">
                                <p><i class="nav-icon fa fa-cogs" aria-hidden="true"></i> CÀI ĐẶT WEBSITE</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <?php 
            if(isset($_POST['btnUpFile']))
            {
              $uid = check_string($_POST['uid']);
              if (check_zip('file_zip') == true)
              {
                $uploads_dir = '../backup/';
                $tmp_name = $_FILES['file_zip']['tmp_name'];
                $create = move_uploaded_file($tmp_name, "$uploads_dir/$uid.zip");
                if($create)
                {
                  echo '<script type="text/javascript">swal("Thành Công","Upfile thành công","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
                  die;
                }
              }
            }
            ?>
            <!-- Modal -->
            <div class="modal fade" id="modalDownBackupVia" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">UPFILE BACKUP VIA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload File Backup (file phải được nén thành ZIP)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                name="file_zip" >
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">UID BACKUP</label>
                                <input type="text" class="form-control" name="uid" placeholder="Nhập UID VIA" required>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">HỦY BỎ</button>
                                <button type="submit" name="btnUpFile"
                                    class="btn btn-primary">UPFILE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>