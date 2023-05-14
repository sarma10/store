<?php 

session_start();
include('koneksi.php');

// session: sebuah va system dari php untuk menyimpan data yg didapatkan dari browser
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username ='$username' AND password ='$password'");
  $cek_login = mysqli_num_rows($query);
  $row = mysqli_fetch_assoc($query);
  if ($cek_login > 0) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['id_user'] = $row['id'];
    header("location: home.php");
  }else{
    header("location: index.php?login=gagal");
  }
}






?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <title>Login</title>
</head>
<body>
  <div
  class="bg-image d-flex justify-content-center align-items-center"
  style="
  background-image: url('img/kota.png');
  height: 100vh;
  "
  >
  <div class="content ">
    <div class="container ">
      <div class="row mx-auto">
        <div class="col mt-5 my-5  ">
          <div class="text" align="center">
            <span>
              <p class="text-monospace font-weight-bolder text-white">HELLO  USER</p>
            </span>
          </div>
          <div class="card text-center" style="width: 22rem;">
            <div class="card-body border border-success">
              <p>User Login</p>

              <?php if (isset($_GET['login']) AND $_GET['login'] == 'gagal'): ?>
                <div class="alert alert-warning">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Upss!</strong> Mohon Periksa Kembali Username dan Password Anda !!
                </div>
              <?php endif ?>
              <?php if (isset($_GET['login']) AND $_GET['login'] == 'access'): ?>
                <div class="alert alert-warning">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Upss!</strong> Anda harus login terlebih dahulu
                </div>
              <?php endif ?>
              <form method="post">
                <div class="form-group text-left">
                  <label for="username">Username</label>
                  <input type="username" class="form-control" id="username" placeholder="name@example" name="username" required>
                  <div class="form-group text-left">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password"  name="password" required>
                  </div>
                  <div class="col-sm my-3"align="center">
                    <a href="" class="text-muted">Forgot Password</a>
                  </div>
                  <button type="submit" class="btn btn-success btn-lg btn-block" name="login" value="login">login</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>   
</div>
</div>
</div>




</body>
</html>