<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="http://zeptojs.com/zepto.min.js"></script>
  <script src="http://localhost:8080/js/keycloak.js"></script>
  <script src="http://localhost/app2/app.js"></script>
  <link rel="stylesheet" href="style.css">
  <script language="JavaScript">
    function Login() {
      const user = document.getElementById("nama_user").value;
      const pass = document.getElementById("kata_sandi").value;

      if (user === "client2" && pass === "client2") {
        localStorage.setItem("username", user);
        localStorage.setItem("data", "Biasa");
        alert("Selamat anda berhasil login");
        window.location.replace("home.php");
      } else {
        alert("Username dan password anda salah!");
      }
    }
  </script>
  <title>Elearning UIGM</title>
</head>

<body>
  <div class="container">
    <img src="logo.png" alt="" width="250px">
    <hr>
    <div class="half-container">
      <div>
        <form>
          <input type="text" name="nama_user" id="nama_user" class="input-user" placeholder="Masukkan Username">
          <input type="password" name="kata_sandi" id="kata_sandi" class="input-pass" placeholder="Masukkan Password">
          <input type="button" value="Login" class="btn-login" onclick="Login()">
          <a id="loginSSO" href="http://localhost/app2/home.php">Go to SSO Login ...</a>
        </form>
      </div>
      <div class="right-container">
        <p>Cookies must be enabled in your browser</p>
        <p>E-Learning Universitas Indo Global Mandiri</p>
      </div>
    </div>

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
              redirectUri: 'http://localhost/app2/home.php',
            });
            window.localStorage.setItem("data", "SSO");
          } else {
            $('#status').html($('<pre>SSO Not Authenticated 🔥</pre>'));
          }
          $('#loginSSO').on('click', function(e) {
            e.preventDefault();

            window.keycloak.login({
              redirectUri: 'http://localhost/app2/home.php',
            });
          });
          $('#logout').on('click', function(e) {
            e.preventDefault();

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