<?php
$useruser = $_GET["profil"];
$userquery = mysqli_query($db, "SELECT*FROM user WHERE user_user='$useruser'");
$datauseruser = mysqli_fetch_array($userquery);

?>
<title><?php echo $datauseruser["nama_user"]; ?> | Pengaturan Akun - 8.5 Web Grup</title>
<?php
if (@$_SESSION["user"] == $useruser) {
?>
    <?php
    if (@$_POST["submitprofil"]) {
        $namaubahprofil = mysqli_real_escape_string($db, $_POST["nama"]);
        $tanggalubahprofil = (int)mysqli_real_escape_string($db, $_POST["tanggal"]);
        $bulanubahprofil = mysqli_real_escape_string($db, $_POST["bulan"]);
        $tahunubahprofil = (int)mysqli_real_escape_string($db, $_POST["tahun"]);
        $jkubahprofil = mysqli_real_escape_string($db, $_POST["jk"]);
        $hpubahprofil = mysqli_real_escape_string($db, $_POST["hp"]);
        $alamatubahprofil = mysqli_real_escape_string($db, $_POST["alamat"]);
        $deskripsiubahprofil = mysqli_real_escape_string($db, $_POST["deskripsi"]);


        $update = mysqli_query($db, "UPDATE user SET nama_user='$namaubahprofil', tanggal_lahir_user='$tanggalubahprofil', bulan_lahir_user='$bulanubahprofil', tahun_lahir_user='$tahunubahprofil', jk_user='$jkubahprofil', hp_user='$hpubahprofil', alamat_user='$alamatubahprofil', bio_user='$deskripsiubahprofil' WHERE user_user='$data2[user_user]'");

        echo "<script>window.location='./?p=edit&profil=';</script>";
    } elseif (@$_POST["submitgambar"]) {
        date_default_timezone_set("Asia/Jakarta");
        $dt = date("Ymd_Gis");
        $usergambar = @$_SESSION["user"];
        $gambar = $_FILES["gambar"]["tmp_name"];
        $tipegambar = $_FILES["gambar"]["size"];
        $alamat_gambar = $_FILES["gambar"]["name"];
        $folder = "assets/img/user/";


        $pindah = @move_uploaded_file($gambar, $folder . $dt . $alamat_gambar);
        if ($pindah) {
            mysqli_query($db, "UPDATE user SET pp_user='$dt$alamat_gambar' WHERE user_user='$useruser'");
            mysqli_query($db, "UPDATE komentar SET pp_penulis='$dt$alamat_gambar' WHERE penulis_komentar='$useruser'");
            echo "<script>window.location='./?p=edit&profil=#ubah-foto';</script>";
        } else {
            echo "<div class='alert alert-danger'>Gagal Upload Gambar. Coba Lagi!</div>";
        }
    } elseif (@$_POST["submitpengaturan"]) {
        $passlam = mysqli_real_escape_string($db, $_POST["passwordlama"]);
        $passbar = mysqli_real_escape_string($db, $_POST["passwordbaru"]);
        if ($passlam == $data2["pass_user"]) {
            mysqli_query($db, "UPDATE user SET pass_user='$passbar' WHERE user_user='$_SESSION[user]'");
            echo "<div class='alert alert-info'>Berhasil Ubah Password!</div>";
        } else {
            echo "<div class='alert alert-danger'>Password Lama Salah!</div>";
        }
    } elseif (@$_POST["resetgambar"]) {
        mysqli_query($db, "UPDATE user SET pp_user='user2.jpg' WHERE user_user='$data2[user_user]'");
        mysqli_query($db, "UPDATE komentar SET pp_penulis='user2.jpg' WHERE penulis_komentar='$data2[user_user]'");
        echo "<script>window.location='./?p=edit&profil=';</script>";
    }
    ?>
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Pengaturan Akun - <?php echo $data2["nama_user"]; ?></h1>


            </div>
        </div>
        <div>
            <h3 id="ubah-foto">Ubah Foto Profil</h3>
            <label for="file">Pilih Gambar</label>
            <?php
            if ($data2["pp_user"] == '') {
            ?>
                <img src="./assets/img/user/user2.jpg" style="float:left; width:250px;height:250px;margin-right:10px;" class="img-thumbnail">
            <?php
            } else {
            ?>
                <img src="./assets/img/user/<?php echo $datauseruser["pp_user"]; ?>" style="float:left; width:250px;height:250px;margin-right:10px;" class="img-thumbnail">
            <?php
            }
            ?>
            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" name="gambar"><br><input value="Perbarui Foto" type="submit" name="submitgambar" class="btn btn-primary"> <input value="Reset Foto Ke Default" type="submit" name="resetgambar" class="btn btn-danger">
            </form>
        </div>
        <div id="user-and-pass" style="margin-top:200px;">
            <hr style="border:1px dashed green;">
            <h3>Ubah Pengaturan</h3>
            <form method="post" action="">
                <b>Username :</b><br>
                <input disabled required style="width:50%" type="text" name="username" value="<?php echo $data2["user_user"]; ?>">
                <li title="Username Tidak Dapat Diubah" onclick="alert('Username Tidak Dapat Diubah')" class="fa fa-question-circle"></li><br><br>
                <b>Ubah Password</b> *abaikan jika tidak ingin diubah<br>
                <input style="width:45%" required type="password" placeholder="masukan password lama..." name="passwordlama">
                <input style="width:45%" type="password" placeholder="masukan password baru..." name="passwordbaru" required><br><br>
                <input style="width:45%;" type="submit" value="Perbarui Pengaturan" name="submitpengaturan" class="btn btn-primary"> <input type="reset" style="width:45%;" class="btn btn-warning">
            </form>
        </div>

        <div id="ubah-data-profil" style="margin-top:50px;">
            <hr style="border:1px dashed green;">
            <h3>Ubah Data Profil</h3>
            <form method="post" action="">

                <b>Nama :</b><br>
                <input required style="width:50%" maxlength="20" type="text" name="nama" value="<?php echo $data2["nama_user"]; ?>"><br><br>

                <br><br>
                <b>Jenis Kelamin :</b><br>
                <input required type="radio" name="jk" <?php if ($data2["jk_user"] == 'Pria') {
                                                            echo "checked";
                                                        }; ?> value="Pria">Pria <input <?php if ($data2["jk_user"] == 'Wanita') {
                                                                                            echo "checked";
                                                                                        }; ?> required type="radio" name="jk" value="Wanita">Wanita<br><br>
                <input type="submit" name="submitprofil" value="Ubah Data Profil" class="btn btn-primary" style="width:40%"> <input type="reset" value="Reset Data" class="btn btn-warning" style="width:40%">
            </form>
        </div>
    </div>
<?php
} else {
    echo "<script>window.location='./?p=edit&profil=$data2[user_user]';</script>";
}
?>