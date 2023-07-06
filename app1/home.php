<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Home</title>
  <script src="http://zeptojs.com/zepto.min.js"></script>
  <script src="http://localhost:8080/js/keycloak.js"></script>
  <script src="http://localhost/app1/app.js"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="header">
    <img src="logo.png" alt="">
    <h2 id="page-title">UNIVERSITAS INDO GLOBAL MANDIRI</h2>
  </div>
  <div class="navbar">
    <a href="#">Beranda</a>
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
  <div id="status"></div>
  <div id="main"></div>

  <div class="main-container">
    <div class="main">
      <div class="card">
        <a class="item" href="#">Profil</a>
        <a class="item" href="#">Bimbingan</a>
        <a class="item" href="#">Jadwal</a>
        <a class="item" href="#">Fasilitas</a>
        <a class="item" href="#">Panduan</a>
      </div>
      <button>Lihat Kalendar Akademik</button>
    </div>
    <div class="sidebar">
      <h2>Pengumuman</h2>
      <p>Tidak ada Pengumuman</p>
    </div>
  </div>

  <script>
    const username = window.localStorage.getItem("username");
    const data = window.localStorage.getItem("data");
    const main = document.getElementById("main");
    if (!username) {
      main.innerHTML = '';
    } else {
      main.innerHTML = '<h3> Selamat Datang, ' + username + '</h3>';
    }


    if (data === "Biasa" || username === "client1") {
      console.log("Login Biasa");
    } else if (data === "SSO") {
      console.log("Login SSO");
    } else if (!data) {
      window.location.replace("index.php");
    }
    $(function() {
      window.keycloak
        .init({
          flow: 'implicit',
          onLoad: 'check-sso',
        })
        .then(function(authenticated) {
          if (authenticated) {
            $('#status').html($('<pre>SSO Authenticated</pre>'));
          } else {
            $('#status').html($('<pre>SSO Not Authenticated</pre>'));
          }
          window.keycloak
            .loadUserInfo()
            .then((data) => {
              main.innerHTML = '<h3> Selamat Datang, ' + data.name + '</h3>';
            })
            .catch((error) => {
              console.log(error);
              localStorage.removeItem('data');
            });

          $('#logout').on('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('username');

            window.keycloak.logout({
              redirectUri: 'http://localhost/app1/index.php',
            });
          });
        })
        .catch(function() {
          console.log('failed to initialize');
        });
    });
  </script>
</body>

</html>