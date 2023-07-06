<?php
include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <script src="http://zeptojs.com/zepto.min.js"></script>
  <script src="http://localhost:8080/js/keycloak.js"></script>
  <script src="http://localhost/app2/app.js"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">Dashboard</a>
    <a href="#">Site Home</a>
    <a href="#">Calender</a>
    <a href="#">Private Files</a>
    <a>My Courses</a>
    <?php
    $data = mysqli_query($koneksi, "SELECT * FROM khs");
    while ($d = mysqli_fetch_array($data)) {
    ?>
      <li><?php echo $d['nama_mk'] ?></li>
    <?php
    }
    ?>
  </div>
  <div class="navbar">
    <span style="font-size:30px;cursor:pointer; color:white;" onclick="openNav()">&#9776;</span>
    <div class="dropdown" style="float: right;">
      <button class="dropbtn" id="profil">
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="#">Dashboard</a>
        <a href="">Profile</a>
        <a title="logout" id="logout" href="http://localhost/app2">Keluar</a>
      </div>
    </div>
  </div>

  <div class="navbar-down">
    <div>
      <img src="logo.png" alt="" width="150px">
    </div>
    <div class="right">
      <div class="navbar">
        <a href="#">Home</a>
        <div class="dropdown">
          <button class="dropbtn" style="color: black; font-size: 20px;">Link
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="#">Website UIGM</a>
            <a href="#">Portal Dosen</a>
            <a href="#">Portal Mahasiswa</a>
            <a href="#">Perpustakaan</a>
            <a href="#">Jurnal</a>
          </div>
        </div>
        <div class="dropdown">
          <button class="dropbtn" style="color: black; font-size: 20px;">English (en)
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="#">English (en)</a>
            <a href="#">Indonesia (id)</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="status"></div>
  <div class="btn-custom">
    <div></div>
    <div><button style="float: right;">Customize this page</button></div>
  </div>
  <div class="main-container">
    <div class="main">
    </div>
    <div class="sidebar">
      <div class="sidebar-up">
        <h2>Recently accessed courses</h2>
        <hr>
        <p>Tidak ada courses</p>
      </div>
      <div class="sidebar-down">
        <h2>Online Users</h2>
        <hr>
        <li>2019110052 - M. Aditya Sahrin</li>
        <li>2019110015 - M. Alamsyah Pratama</li>
        <li>2019110051 - Nayaka Al Syahreal Kanaka</li>
      </div>
    </div>
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
    const username = window.localStorage.getItem("username");
    const data = window.localStorage.getItem("data");
    const profil = document.getElementById("profil");
    if (!username) {
      profil.innerHTML = '';
    } else {
      profil.innerHTML = '<h3> Selamat Datang, ' + username + '</h3>';
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
              profil.innerHTML = '<h3> Selamat Datang, ' + data.name + '</h3>';
            })
            .catch((error) => {
              console.log(error);
              localStorage.removeItem('data');
            });

          $('#logout').on('click', function(e) {
            e.preventDefault();
            localStorage.removeItem('username');

            window.keycloak.logout({
              redirectUri: 'http://localhost/app2/index.php',
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