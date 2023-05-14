<?php 
session_start();

// jika session ada dia bisa masuk ke halaman home, jika tidak ada kita lempar ke halaman login

if (empty($_SESSION['username'])) {
	header("location:index.php?login=access");
}

include 'koneksi.php';

// jika tombol bernama add diklik action adalah : masukan kedalam table use, dimana nilainya diambil dari inputan, fullname=inputan fullname.
// Jika berhasil lempar kehalaman user, kalo gagal kembali kehalaman tambah user

if (isset($_POST['add'])) {
	$kategori = $_POST['kategori'];
	$jenis_kategori = $_POST['jenis_kategori'];

	$insert = mysqli_query($koneksi, "INSERT INTO tbl_kategori (kategori, jenis_kategori) VALUES ('$kategori', '$jenis_kategori')");
	if ($insert) {
		header("location:kategori.php?tambah=berhasil");
	}
}

// Jika ada parameter yang bernama delete maka id diambil dari 
if (isset($_GET['delete'])) {
	$id = $_GET['delete']; 

	$delete = mysqli_query($koneksi, "DELETE FROM tbl_kategori WHERE id='$id'");
	if ($delete) {
		header("location:kategori.php?hapus=berhasil");
	}else{
		header("location:kategori.php?hapus=gagal");
	}
}

// Jika paramete edit ada maka diambil dari nilai id
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];

	$editData = mysqli_query($koneksi, "SELECT * FROM tbl_kategori WHERE id='$id'");
	$editData = mysqli_fetch_assoc($editData);
}

// Mengubah data dari yang sudah ada jadi baru berdasarkan primary key atau id lempar ke halaman Menu.
if (isset($_POST['edit'])) {
	$kategori = $_POST['kategori'];
	$jenis_kategori = $_POST['jenis_kategori'];
	$id = $_GET['edit'];

	$update = mysqli_query($koneksi, "UPDATE tbl_kategori SET kategori ='$kategori', jenis_kategori ='$jenis_kategori' WHERE id='$id' ");

	if ($update) {
		header("location:kategori.php?ubah=berhasil");
	}
}


// buat satu buah table bernama kategori (id, type:enum, name, created_at, update_at) buat crud (listing, tambah, ubah, hapus)

?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
			<style>
				.center {
					margin: 100px auto;
					float: none;
				}
			</style>
		</head>
		<body>
			<?php include('inc/navbar.php') ?>
			<div
			class="bg-image d-flex justify-content-center align-items-center"
			style="
			background-image: url('img/pattern.png');
			height: 80vh;
			"
			>




			
			<div class="container mt-5">
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="card-title">
									<!-- Shorthand if php -->
									<h3><?php echo isset($_GET['edit'])?'Edit' : 'Tambah'  ?> Data Kategori</h3>
								</div>

								<?php if (isset($_GET['edit'])): ?>
									<!-- Diisi form edit Menu -->
									<form method="post">
										<div class="form-group">
											<label>Nama Kategori </label>
											<input type="text" name="kategori" class="form-control" placeholder="Nama Kategori" value="<?php echo $editData['kategori'] ?>">
										</div>
										<div class="form-group">
											<label>Jenis Kategori </label>
											<select name="jenis_kategori" class="form-control" placeholder="Jenis Kategori"><option value="paket">paket</option><option value="non_paket">non paket</option>
											</select>
										</div>										
										<div class="form-group">
											<input type="submit" name="edit" class="btn btn-primary mt-5" value="Simpan">
										</div>
									</form>
								<?php else: ?>
									<!-- Diisi form tambah Menu -->
									<form method="post">
										<div class="form-group">
											<label>Nama Kategori *</label>
											<input type="text" name="kategori" class="form-control" placeholder="Nama Kategori">
										</div>
										<div class="form-group">
											<label>Jenis Kategori</label>
											<select type="text" name="jenis_kategori" class="form-control" placeholder="Jenis Kategori">
												<option value="paket">paket</option>
												<option value="non_paket">non paket</option>
											</select>
										</div>										
										<div class="form-group">
											<input type="submit" name="add" class="btn btn-primary mt-5" value="Simpan">
										</div>
									</form>
								<?php endif ?>



							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	</body>
	</html>

