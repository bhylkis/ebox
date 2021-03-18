<?php
session_start();
include '../inc/config-konek.php';
if (@$_SESSION["user"]) {
    header("location:../?p=beranda");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="icon" href="../assets/img/icon.png" type="image/jpg" size="50px">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In Ebox</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='https://fonts.googleapis.com/css2?family=Poppins&display=swap' rel='stylesheet' type='text/css' />

</head>

<body style="background-color:#ebf1ff">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <style>
                    .login {
                        color: black;
                        text-decoration: none;
                        transition: color 0.3s;
                    }

                    .login:hover {
                        color: #003bc4;
                        text-decoration: none;
                    }
                </style>
                <a href="../" class="login">
                    <font style="font-family:Poppins; font-size:35px;"><b>Sign In</b></font><br><br>
                    Masuk untuk menambahkan saran
                </a>
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <?php
                        if (@$_POST["submit"]) {
                            $user = mysqli_real_escape_string($db, $_POST["username"]);
                            $pass = mysqli_real_escape_string($db, $_POST["password"]);
                            $e = false;
                            if (empty($user) && empty($pass)) {
                                echo "<div class='alert alert-warning'>Username Dan Password Tidak Boleh Kosong</div>";
                                $e = true;
                            } elseif (empty($user)) {
                                echo "<div class='alert alert-warning'>Username Tidak Boleh Kosong</div>";
                                $e = true;
                            } elseif (empty($pass)) {
                                echo "<div class='alert alert-warning'>Password Tidak Boleh Kosong</div>";
                                $e = true;
                            }
                            if ($e == false) {
                                $querylogin = mysqli_query($db, "SELECT*FROM user WHERE user_user='$user' AND pass_user='$pass'");
                                $datalogin = mysqli_fetch_array($querylogin);
                                $beda = $datalogin["user_user"];
                                $ceklogin = mysqli_num_rows($querylogin);
                                if (empty($ceklogin)) {
                                    echo "<div class='alert alert-danger'>Username Atau Password Anda Salah</div>";
                                } else {
                                    $_SESSION["user"] = $beda;
                                    date_default_timezone_set("Asia/Jakarta");
                                    $tanggal_login = date("G:i d/m/Y");
                                    mysqli_query($db, "UPDATE user SET tanggal_login_user='$tanggal_login' WHERE user_user='$user'");
                                    mysqli_query($db, "UPDATE user SET status_user='Online' WHERE user_user='$user'");
                                    $ngepos = @$_GET["post"] . "&id=";
                                    $redipos = @$_GET["id"] . "&post_by=";
                                    $rekpos = @$_GET["post_by"];
                                    $redpos = $ngepos . $redipos . $rekpos;
                                    if (isset($ngepos) && isset($redipos) && isset($rekpos)) {
                                        header("location:$redpos#komentar");
                                    } else {

                                        header("location:../?p=beranda");
                                    }
                                }
                            }
                        }
                        ?>
                        <hr />
                        <h5>Semua kotak harus diisi</h5>
                        <br />
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="username" placeholder="Username" autofocus />
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <span class="pull-right">
                                <a href="#" onclick="alert('Silahkan kontak admin untuk mendapatkan password')">Lupa Password ? </a>
                            </span>
                        </div>

                        <input type="submit" name="submit" value="Sign In" class="btn btn-primary ">
                        <hr />
                        <?php
                        $regsql = mysqli_fetch_array(mysqli_query($db, "SELECT*FROM tegar"));
                        if ($regsql["izin_reg_tegar"] == 1) {
                        ?>
                            <center></a>Kembali Ke <a href="../?p=beranda">Beranda</a></center>

                            <center></a>Belum Daftar? <a href="../reg.php">Klik Disini </a></center>
                        <?php
                        } else {
                        ?>
                            Kembali Ke <a href="../?p=beranda">Beranda</a>
                        <?php
                        }
                        ?>
                    </form>
                </div>

            </div>


        </div>
    </div>
</body>

</html>