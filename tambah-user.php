<?php 
session_start();

if (empty($_SESSION['username'])) {
  header("location:index.php?login=access");
}
include 'koneksi.php';
// jika tombol add ditekab maka actionnya adalah: masukan ke dalam tabel user lainya di ambil dari inputan, fullname=inputan fulname jika berhasil lempar ke halaman user, jika gagal balik ke halaman tambah-usr

if (isset($_POST['add'])) {
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $insert = mysqli_query($koneksi, "INSERT INTO tbl_user (fullname, username, password) VALUES ('$fullname','$username', '$password')");
  if ($insert) {
    header("location:user.php?tambah=berhasil");
  }
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $delete = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id='$id'");
  if ($delete) {
    header("location: user.php?hapus=berhasil");
  }else{
    header("location: user.php?hapus=gagal");
  }

}

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $editData = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id='$id'");
  $editData= mysqli_fetch_assoc($editData);
  
}

// mengubah data dari yang sudah ada jadi baru berdasarkan primary key atau id lempar ke halaman user

if (isset($_POST['edit'])) {
 $fullname = $_POST['fullname'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $id = $_GET['edit'];

  $update = 
   mysqli_query($koneksi, "UPDATE tbl_user SET fullname ='$fullname', username ='$username', password ='$password' WHERE id = '$id'");
if ($update) {
  header ("location: user.php?ubah=berhasil");
}

}
?>

<!-- buat salah satu table mengenai makanan atau minuman dg kategori (id, type:enum, nama, created at) buat crud (listing, tambah, ubah, hapus) -->

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Dashboard </title>
</head>
<body>
 <?php include('inc/navbar.php'); ?>
 <div class="header-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-md-12">


      </div>
    </div>
  </div>
  <div class="content">
    <div class="container mt-5">
      <div class="row">
       <div class="col">
        <div class="card">
         <div class="card-body">
          <div class="card-title">
            <!-- shorthand if php -->
            <h3><?php echo isset($_GET['edit'])?'Edit' : 'Tambah' ?> data User</h3>
          </div>

          <?php if (isset($_GET['edit'])): ?>
           <form method="post">
            <div class="form-grup"> 
              <label> Nama Lengkap</label>
              <input type=" text" name="fullname" class="form-control" placeholder="Nama Lengkap" value="<?php echo $editData['fullname']?>">
            </div>  
            <div class="form-grup"> 
              <label> Username</label>
              <input type=" text" name="username" class="form-control" placeholder="Username" value="<?php echo $editData['username']?>">
            </div> 
            <div class="form-grup"> 
              <label> Password</label>
              <input type=" password" name="password" class="form-control" placeholder="password">
            </div> 
            <div class="form-grup mb-3"> 
              <input type="submit" name="edit" class="btn btn-primary " value="simpan">
            </div> 
          </form>
        <?php else: ?>
         <form method="post">
          <div class="form-grup"> 
            <label> Nama Lengkap</label>
            <input type=" text" name="fullname" class="form-control" placeholder="Nama Lengkap">
          </div>  
          <div class="form-grup"> 
            <label> Username</label>
            <input type=" text" name="username" class="form-control" placeholder="username">
          </div> 
          <div class="form-grup"> 
            <label> Password</label>
            <input type=" password" name="password" class="form-control" placeholder="password">
          </div> 
          <div class="form-grup mb-3"> 
            <input type="submit" name="add" class="btn btn-primary " value="simpan">
          </div> 
        </form>
      <?php endif ?>



    </div>
  </div>
</div>
</div>
</div>
</div>
</div>


</body>
</html>