<link rel="icon" href="assets/img/icon.png" type="image/jpg" size="30px">
<link rel="stylesheet" href="assets/css/basic1.css" />
<script src="./assets/js/ngomen.js"></script>

<?php
include "./inc/config-konek.php";
session_start();
$querypost = mysqli_query($db, "SELECT*FROM post ORDER BY id_post DESC");
$query1 = mysqli_query($db, "SELECT*FROM user ORDER BY tanggal_login_user DESC");
if (@$_SESSION["user"]) {
    $dataliatkomen = mysqli_fetch_array(mysqli_query($db, "SELECT*FROM lihat WHERE user_lihat='$_SESSION[user]' AND apa_lihat='komentar'"));
    mysqli_query($db, "UPDATE user SET status_user='Online' WHERE user_user='$_SESSION[user]'");
    $query2 = mysqli_query($db, "SELECT*FROM user WHERE user_user='$_SESSION[user]'");
    $data2 = mysqli_fetch_array($query2);
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap1.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome1.css" rel="stylesheet" />
        <!--CUSTOM BASIC STYLES-->
        <link href="assets/css/basic1.css" rel="stylesheet" />
        <!--CUSTOM MAIN STYLES-->
        <link href="assets/css/custom1.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='https://fonts.googleapis.com/css2?family=Poppins&display=swap' ; rel='stylesheet' type='text/css' />
    </head>
    <style>
        a:focus {
            color: #2a6496;
        }
    </style>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">Kotak Saran<br><i style="font-size:14px;">SMKN 26 JAKARTA</i></a>
                </div>

                <div class="header-right">
                    <a href="./?p=user&user=<?php echo $data2["user_user"]; ?>#post" class="btn btn-warning" title="Postingan Anda">
                        <b>
                            <?php
                            $querypostinganuser = mysqli_query($db, "SELECT*FROM post WHERE penulis_post='$_SESSION[user]'");
                            $cekpostinganuser = mysqli_num_rows($querypostinganuser);
                            echo $cekpostinganuser;
                            ?>
                        </b>
                        <i class="fa fa-pencil fa-2x"></i></a>
                    <a href="./?p=komentar&post_user=<?php echo $data2["user_user"]; ?>" class="btn btn-primary" title="Notifikasi Komentar">
                        <b>
                            <?php
                            $querykomentaruser = mysqli_query($db, "SELECT*FROM komentar WHERE penulis_post='$data2[user_user]' AND penulis_komentar!='$_SESSION[user]'");

                            $cekkomentaruser = mysqli_num_rows($querykomentaruser);

                            echo $cekkomentaruser;

                            ?>
                        </b>
                        <i class="fa fa-comment-o fa-2x"></i>
                        <?php
                        if ($dataliatkomen["lihat"] == 1) {
                        ?>
                            <li class="badge" style="color:darkred;position:absolute;">Baru</li>
                        <?php
                        } else {
                        }
                        ?>
                    </a>


                    <a href="./?p=jempol&post_user=<?php echo $data2["user_user"]; ?>" class="btn btn-primary" title="Notifikasi Suka">
                        <b>
                            <?php
                            $queryjempoluser = mysqli_query($db, "SELECT*FROM suka_post WHERE penulis_post='$data2[user_user]' AND user_suka!='$_SESSION[user]'");
                            $querylihatjempol = mysqli_query($db, "SELECT*FROM lihat WHERE user_lihat = '$_SESSION[user]' AND apa_lihat='like'");
                            $datajempoluser = mysqli_fetch_array($querylihatjempol);
                            $cekjempoluser = mysqli_num_rows($queryjempoluser);

                            echo $cekjempoluser;

                            ?>
                        </b>
                        <i class="fa fa-thumbs-up fa-2x"></i> <?php
                                                                if ($datajempoluser["lihat"] == 1) {
                                                                ?>
                            <li class="badge" style="color:darkred;position:absolute;">Baru</li>
                        <?php
                                                                } else {
                                                                }
                        ?>
                    </a>


                    <button onclick="window.location='./login/logout.php';" class="btn btn-danger" title="Sign Out"><i class="fa fa-sign-out fa-2x"></i></button>

                </div>
            </nav>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li>
                            <div class="user-img-div">
                                <?php
                                if ($data2["pp_user"] == '') {
                                ?>
                                    <a href="./assets/img/user/user2.jpg"><img src="assets/img/user/user2.jpg" class="img-thumbnail"></a>
                                <?php
                                } else {
                                ?>
                                    <a href="./assets/img/user/<?php echo $data2["pp_user"]; ?>"><img src="assets/img/user/<?php echo $data2["pp_user"]; ?>" class="img-thumbnail"></a>
                                <?php
                                }
                                ?>

                                <div class="inner-text">
                                    <a style="color:white" href="./?p=user&user=<?php echo $data2["user_user"]; ?>"><?php echo $data2["nama_user"]; ?></a><br>
                                    <?php echo $data2["user_user"]; ?>
                                    <br />
                                    <?php
                                    if ($data2["status_user"] == 'Online') {
                                    ?>
                                        <a href="#" class="btn btn-success btn-circle" style="width:10px;height:10px;"></a> Online
                                    <?php
                                    } elseif ($data2["status_user"] == 'Offline') {
                                    ?>
                                        <a href="#" class="btn btn-default btn-circle" style="width:10px;height:10px;"></a> Offline
                                    <?php
                                    }
                                    ?>
                                    <br>
                                    <small>Login : <?php echo $data2["tanggal_login_user"]; ?> </small>
                                </div>
                            </div>

                        </li>


                        <li>
                            <a title="Halaman Utama" class="active-menu" href="./"><i class="fa fa-home "></i>Beranda</a>
                        </li>
                        <li>
                            <a href="#" title="Tentang Saya"><i class="fa fa fa-user "></i><?php echo $data2["nama_user"]; ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a title="Profil Saya" href="./?p=user&user=<?php echo $data2["user_user"]; ?>"><i class="fa fa-smile-o"></i>Profil</a>
                                </li>
                                <li>
                                    <a title="Pengaturan Akun" href="./?p=edit&profil=<?php echo $data2["user_user"]; ?>"><i class="fa fa-gears"></i>Pengaturan</a>
                                </li>
                                <li>
                                    <a href="./?p=posting&profil=<?php echo $data2["user_user"]; ?>"><i class="fa fa-pencil"></i>Buat Postingan</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="#" title="Tentang Seluruh Pengguna"><i class="fa fa fa-users "></i>Pengguna<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="./?p=daftar_pengguna" title="Pengguna Terdaftar"><i class="fa fa-list"></i>Daftar Pengguna</a>
                                </li>

                            </ul>
                        <li>
                            <a href="#" title="Daftar Pengguna Online"><i class="fa fa fa-circle "></i>Online <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
                                $querypenggunaonline = mysqli_query($db, "SELECT*FROM user WHERE status_user='Online' ORDER BY tanggal_login_user DESC");
                                while ($datapenggunaonline = mysqli_fetch_array($querypenggunaonline)) {
                                ?>
                                    <li>
                                        <a title="<?php echo $datapenggunaonline["nama_user"]; ?> Sedang Online" href="./?p=user&user=<?php echo $datapenggunaonline["user_user"]; ?>"><i class="fa fa-user"></i><?php echo $datapenggunaonline["nama_user"]; ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                        </li>
                    </ul>
                    </li>

                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <?php
                $user = @$_GET["user"];
                $p = @$_GET["p"];
                if ($user) {
                    include 'inc/user.php';
                } elseif (empty($p)) {
                    include 'inc/dashboard.php';
                } elseif ($p == 'beranda') {
                    include 'inc/dashboard.php';
                } elseif ($p == 'post') {
                    include 'inc/read.php';
                } elseif ($p == 'daftar_pengguna') {
                    include 'inc/member.php';
                } elseif ($p == 'edit') {
                    include 'inc/edit-user.php';
                } elseif ($p == 'komentar') {
                    include "inc/komentar-kamu.php";
                } elseif ($p == 'posting') {
                    include 'inc/newpost.php';
                } elseif ($p == 'galeri') {
                    include 'inc/galeri.php';
                } elseif ($p == 'jempol') {
                    include 'inc/jempol.php';
                } elseif ($p == 'galeriku') {
                    include 'inc/galeriku.php';
                } elseif ($p == 'diskusi') {
                    include 'inc/diskusi.php';
                } else {
                    echo "<script>window.location='./error';</script>";
                }
                ?>
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->

        <div id="footer-sec">
            &copy; 2021 Ebox 26 <span style="float:right;">Design By : <b>Kelompok 5</b>
        </div>
        <!-- /. FOOTER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap1.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome1.css" rel="stylesheet" />
        <!--CUSTOM BASIC STYLES-->
        <link href="assets/css/basic1.css" rel="stylesheet" />
        <!--CUSTOM MAIN STYLES-->
        <link href="assets/css/custom1.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='https://fonts.googleapis.com/css2?family=Poppins&display=swap' rel='stylesheet' type='text/css' />
    </head>
    <style>
        a:focus {
            color: #2a6496;
        }
    </style>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header" style="background: #004cff;">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">Ebox<br><i style="font-size:14px;">SMKN 26 Jkaarta</i></a>
                </div>

                <div class="header-right">
                    <a href="login" class="btn btn-primary" title="Masuk"><i class="fa fa-sign-in fa-2x"></i></a>

                </div>
            </nav>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li>
                            <div style="height:10px;background:#4380B8">
                            </div>

                        </li>


                        <li>
                            <a class="active-menu" href="./"><i class="fa fa-home "></i>Beranda</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa fa-users "></i>Pengguna <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="./login/"><i class="fa fa-reply"></i>Login</a>
                                </li>
                                <li>
                                    <a href="./?p=daftar_pengguna"><i class="fa fa-list "></i>Daftar Pengguna</a>
                                </li>
                            </ul>
                        </li>
                        <li>

                        </li>
                    </ul>

                </div>

            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <?php
                $user = @$_GET["user"];
                $p = @$_GET["p"];
                if ($user) {
                    include 'inc/user.php';
                } elseif (empty($p)) {
                    include 'inc/dashboard.php';
                } elseif ($p == 'beranda') {
                    include 'inc/dashboard.php';
                } elseif ($p == 'post') {
                    include 'inc/read.php';
                } elseif ($p == 'daftar_pengguna') {
                    include 'inc/member.php';
                } elseif ($p == 'edit') {
                    echo "<script>window.location='./error';</script>";
                } elseif ($p == 'galeri') {
                    include 'inc/galeri.php';
                } elseif ($p == 'reg') {
                    include 'assets/img/user/reg.php';
                } elseif ($p == 'galeriku') {
                    include 'inc/galeriku.php';
                } else {
                    echo "<script>window.location='./error';</script>";
                }
                ?>
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->

        <div id="footer-sec">
            &copy; 2021 Ebox 26. All Right Reserved <span style="float:right;">Design By : <b>Kelompok 5</b>
        </div>
        <!-- /. FOOTER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php
}
?>