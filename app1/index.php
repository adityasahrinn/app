<?php
include('koneksi.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="http://zeptojs.com/zepto.min.js"></script>
  <script src="http://localhost:8080/js/keycloak.js"></script>
  <script src="http://localhost/app1/app.js"></script>
  <link rel="stylesheet" href="style.css">
  <script language="JavaScript">
    function Login() {
      const user = document.getElementById("nama_user").value;
      const pass = document.getElementById("kata_sandi").value;

      if (user === "client1" && pass === "client1") {
        localStorage.setItem("username", user);
        localStorage.setItem("data", "Biasa");
        alert("Selamat anda berhasil login");
        window.location.replace("home.php");
      } else {
        alert("Username dan password anda salah!");
      }
    }
  </script>
  <title>Student Form Login</title>
</head>

<body>
  <div class="container">
    <h2>STUDENT FORM LOGIN</h2>
    <hr>
    <form>
      <input type="text" name="nama_user" id="nama_user" class="input-user" placeholder="Masukkan Username">
      <input type="password" name="kata_sandi" id="kata_sandi" class="input-pass" placeholder="Masukkan Password">
      <input type="button" value="Login" class="btn-login" onclick="Login()">
    </form>
    <a id="loginSSO" href="http://localhost/app1/home.php">Go to SSO Login ...</a>
  </div>
  <script>
    $(function() {
      window.keycloak
        .init({
          flow: 'implicit',
          onLoad: 'check-sso',
        })
        .then(function(authenticated) {
          if (authenticated) {
            window.keycloak.login({
              redirectUri: 'http://localhost/app1/home.php',
            });
            window.localStorage.setItem("data", "SSO");
          } else {
            $('#status').html($('<pre>SSO Not Authenticated</pre>'));
          }
        })
        .catch(function() {
          console.log('failed to initialize');
        });
      $('#loginSSO').on('click', function(e) {
        e.preventDefault();

        window.keycloak.login({
          redirectUri: 'http://localhost/app1/home.php',
        });

        localStorage.setItem("data", "SSO");
      });
    });
  </script>
</body>

</html>