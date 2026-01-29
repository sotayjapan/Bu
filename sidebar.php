<body class="header-dark sidebar-dark">
<?php 
    if(empty($_SESSION['username']))
    {
        die('<script type="text/javascript">setTimeout(function(){ location.href = "/login/" },0);</script>');
    }
?>
<?php
    if ($site['site_baotri'] == 'ON')
    {
        echo '<script type="text/javascript">swal("Thông Báo", "Hệ thống đang bảo trì định kỳ, xin quý khách vui lòng quay lại sau.", "warning");</script>';
        die();
    } 
    if ($user['banned'] == 1)
    {
        echo '<script type="text/javascript">swal("Thông Báo", "Tài khoản đã bị khóa!", "warning");
        setTimeout(function(){ location.href = "/log-out/" },3000);</script>';
        die();
    } 
?>
<?php 
    if(isset($_POST['btnGet2FA']) && isset($_SESSION['username']) )
    {
        $key = check_string($_POST['key']);
        $data = json_decode(curl_get($site_domain."2fa/index.php?key=".$key), true);
        if (isset($data['code']))
        {
            echo '<script type="text/javascript">swal("'.$data['code'].'","Mã chỉ tồn tại sau 30s","success");</script>';
        }
    }
    if(isset($_POST['btnDownloadBackup']) && isset($_SESSION['username']) )
    {
        $uid = check_string($_POST['uid']);
        if(empty($uid))
        {
            die('<script type="text/javascript">swal("Thất Bại", "Vui lòng nhập UID cần Download Backup!", "warning");setTimeout(function(){ location.href = "/log-out/" },3000);</script>');
        }
        else
        {
            $file = $site['domain']."backup/$uid.zip";
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"$uid.zip\""); 
            echo readfile($file);
        }
    }
?>


    <div class="header" style="background:<?=$site['color'];?>">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
            <div class="header-search" style="background:<?=$site['color'];?>">
                <form action="/" method="post">
                    <div class="form-group mb-0">
                        <i class="dw dw-search2 search-icon"></i>
                        <input type="text" class="form-control search-input" name="btnTimTaiKhoan"
                            placeholder="Tìm tài khoản...">
                    </div>
                </form>
            </div>
        </div>
        <div class="header-right">
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                <?php $i = 0; $show_logs = $ketnoi->query("SELECT * FROM `thongbao` ORDER BY id desc"); while($row = $show_logs->fetch_assoc() ){ ?>
                                <li>
                                    <a>
                                        <img src="/vendors/images/news.png" alt="<?=$row['content'];?>">
                                        <h3><?=$row['title'];?></h3>
                                        <p><?=$row['content'];?></p>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="/vendors/images/photo1.jpg" alt="">
                        </span>
                        <span class="user-name"><?=$user['username'];?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="/profile/"><i class="dw dw-user1"></i> Trang Cá Nhân</a>
                        <a class="dropdown-item" href="/support/"><i class="dw dw-help"></i> Hỗ Trợ</a>
                        <a class="dropdown-item" href="/log-out/"><i class="dw dw-logout"></i> Đăng Xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="left-side-bar" style="background:<?=$site['color'];?>">
        <div class="brand-logo">
            <a href="/">
                <img src="<?=$site['site_logo'];?>" alt="<?=$site['site_tenweb'];?>" class="dark-logo">
                <img src="<?=$site['site_logo'];?>" alt="<?=$site['site_tenweb'];?>" class="light-logo">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <a class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-money-2"></span><span class="mtext">Số Dư: <b
                                    style="color:yellow;"><?=format_cash($user['money']);?></b>đ</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a href="/" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-house-1"></span><span class="mtext"><?=$lang['side1'];?></span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-shopping-cart"></span><span
                                class="mtext"><?=$lang['side2'];?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/index.php?loai=bm">Mua BM</a></li>
                            <li><a href="/index.php?loai=clone">Mua CLONE Facebook</a></li>
                            <li><a href="/index.php?loai=via">Mua VIA</a></li>
                            <li><a href="/index.php?loai=hotmail">Mua Hotmail</a></li>
                            <li><a href="/index.php?loai=gmail">Mua Gmail</a></li>
                          <!--  <li><a href="/index.php?loai=azure">Mua Tài Khoản Azure</a></li> -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-money-2"></span><span class="mtext"><?=$lang['side3'];?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/pay/card/">Nạp Bằng Thẻ Cào Auto</a></li>
                            <li><a href="/pay/momo/">Nạp Bằng MOMO Auto</a></li>
                          
                        </ul>
                    </li>
                    <li>
                        <a href="/history/orders/" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-shopping-bag1"></span>
                            <span class="mtext"><?=$lang['side4'];?></span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon dw dw-briefcase"></span><span class="mtext"><?=$lang['side5'];?></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#" data-toggle="modal" data-target="#modalGet2FA">GET 2FA</a></li>
                            <li><a href="/tools/check-live-clone/">Check Live Clone</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modalDownBackupVia">Download Backup
                                    Via</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/giftcode/" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-gift"></span>
                            <span class="mtext"><?=$lang['side6'];?></span>
                        </a>
                    </li>
                <!--    <li>
                        <a href="/affiliate-manager/" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-analytics1"></span>
                            <span class="mtext"><?=$lang['side7'];?></span>
                        </a>
                    </li> -->
                    <li>
                        <a href="/support/" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-support"></span>
                            <span class="mtext"><?=$lang['side8'];?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$site['facebook'];?>" target="_blank" class="dropdown-toggle no-arrow">
                            <span class="micon fa fa-facebook"></span>
                            <span class="mtext"><?=$lang['side9'];?></span>
                        </a>
                    </li>
                    <?php if($user['level'] == 'admin'){ ?>
                    <li>
                        <a href="/admin/" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-settings2"></span>
                            <span class="mtext">Quản Trị Website</span>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalGet2FA" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">GET 2FA FACEBOOK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <label>Nhập Secret Key:</label>
                        <br>
                        <div class="input-group custom">
                            <input name="key" type="text" placeholder="VD: YK57NHDDKJ3XBNKFD2IMZ52TVZPCGMOH"
                                class="form-control form-control-lg" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy ion-lock-combination"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">HỦY BỎ</button>
                        <button type="submit" name="btnGet2FA" class="btn btn-primary">TẠO KEY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalDownBackupVia" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">DOWNLOAD BACKUP VIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <label>Nhập UID Via Cần Download Backup:</label>
                        <br>
                        <div class="input-group custom">
                            <input name="uid" type="text" placeholder="1003265988556" class="form-control form-control-lg"
                                required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy ion-lock-combination"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">HỦY BỎ</button>
                        <button type="submit" name="btnDownloadBackup" class="btn btn-primary">DOWNLOAD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>