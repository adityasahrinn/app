<?php
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>KHS</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="header">
        <img src="logo.png" alt="">
        <h2 id="page-title">UNIVERSITAS INDO GLOBAL MANDIRI</h2>
    </div>
    <div class="navbar">
        <a href="home.php">Beranda</a>
        <div class="dropdown">
            <button class="dropbtn">Akun
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Ubah Profil</a>
                <a href="#">Ubah Password</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Civitas
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Bimbingan</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Aktivitas
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="khs.php">KHS</a>
                <a href="#">DKN</a>
                <a href="#">KRS</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Keuangan
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Tagihan</a>
                <a href="#">Transkrip Finansial</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Fasilitas
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#">Catalog</a>
                <a href="#">Perkembangan Akademik</a>
            </div>
        </div>
        <a href="#">Formulir</a>
        <a href="#">Keluhan</a>
        <a title="logout" id="logout" href="http://localhost/app1">Keluar</a>
    </div>
    <div class="table-container">
        <h2>Kartu Hasil Studi</h2>
        <table>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Kode</th>
                <th rowspan="2">Mata Kuliah</th>
                <th rowspan="2">SKS</th>
                <th rowspan="2">Huruf</th>
                <th rowspan="2">Jumlah</th>
                <th colspan="2">Validasi</th>
            </tr>
            <tr>
                <th>Prodi</th>
                <th>BAAK</th>
            </tr>
            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM khs");
            $jumlahsem = 0;
            $totsks = 0;
            $totjumlah = 0;
            while ($d = mysqli_fetch_array($data)) {
                if ($d['huruf_mk'] === "A") {
                    $jumlahsem = 4;
                    $jumlah = $jumlahsem * $d['sks_mk'];
                } elseif ($d['huruf_mk'] === "B") {
                    $jumlahsem = 3;
                    $jumlah = $jumlahsem * $d['sks_mk'];
                } elseif ($d['huruf_mk'] === "C") {
                    $jumlahsem = 2;
                    $jumlah = $jumlahsem * $d['sks_mk'];
                } else {
                    $jumlahsem = 1;
                    $jumlah = $jumlahsem * $d['sks_mk'];
                }
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['kode_mk'] ?></td>
                    <td style="text-align: left;"><?php echo $d['nama_mk'] ?></td>
                    <td><?php echo $d['sks_mk'] ?></td>
                    <td><?php echo $d['huruf_mk'] ?></td>
                    <td><?php echo $jumlah ?></td>
                    <td>Y</td>
                    <td>Y</td>
                <?php
                $totsks += $d['sks_mk'];
                $totjumlah += $jumlah;
            }
                ?>

                </tr>
                <tr>
                    <td colspan="3">Total</td>
                    <td><?php echo $totsks ?></td>
                    <td></td>
                    <td><?php echo $totjumlah ?></td>
                </tr>
    </div>
</body>

</html>