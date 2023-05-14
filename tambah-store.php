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
	$id_barang = $_POST['id_barang'];
	$nama_barang = $_POST['nama_barang'];
	$qty = $_POST['qty'];
	$harga = $_POST['harga'];
	

	$insert = mysqli_query($koneksi, "INSERT INTO tbl_barang (id_barang, nama_barang, qty, harga) VALUES ('$id_barang', '$nama_barang', '$qty', '$harga')");
	if ($insert) {
		header("location:store.php?tambah=berhasil");
	}
}

// Jika ada parameter yang bernama delete maka id diambil dari 
if (isset($_GET['delete'])) {
	$id = $_GET['delete']; 

	$delete = mysqli_query($koneksi, "DELETE FROM tbl_barang WHERE id='$id'");
	if ($delete) {
		header("location:store.php?hapus=berhasil");
	}else{
		header("location:store.php?hapus=gagal");
	}
}

// Jika paramete edit ada maka diambil dari nilai id
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];

	$editData = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE id='$id'");
	$editData = mysqli_fetch_assoc($editData);
}

// Mengubah data dari yang sudah ada jadi baru berdasarkan primary key atau id lempar ke halaman Menu.
if (isset($_POST['edit'])) {
	$id_barang = $_POST['id_barang'];
	$nama_barang = $_POST['nama_barang'];
	$qty = $_POST['qty'];
	$harga = $_POST['harga'];
	$id = $_GET['edit'];

	$update = mysqli_query($koneksi, "UPDATE tbl_barang SET id_barang = '$id_barang', nama_barang ='$nama_barang', qty = '$qty', harga = '$harga' WHERE id='$id' ");

	if ($update) {
		header("location:store.php?ubah=berhasil");
	}
}

$kategori = mysqli_query($koneksi, "SELECT * FROM tbl_kategori ORDER BY id DESC");


// buat satu buah table bernama kategori (id, type:enum, name, created_at, update_at) buat crud (listing, tambah, ubah, hapus)

?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>STORE</title>

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
									<h3><?php echo isset($_GET['edit'])?'Edit' : 'Tambah'  ?> Data Store</h3>
								</div>

								<?php if (isset($_GET['edit'])): ?>
									<!-- Diisi form edit Menu -->
									<form method="post">
										<div class="form-group">
											<label>Kategori Barang</label>
											<select type="id_barang" name="id_barang" class="form-control">
												<option value="">--pilih kategori--</option>
												<!-- LOOPING -->
												<?php  while($rowkategori = mysqli_fetch_assoc($kategori)) { ?>
													<option <?php echo ($editData['id_barang'] == $rowkategori['id'])?'selected':'' ?> value="<?php echo $rowkategori['id']?>"><?php echo $rowkategori['kategori']; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label>Nama Barang</label>
											<input type="text" name="nama_barang" class="form-control" placeholder="nama barang" value="<?php echo $editData['nama_barang']; ?>">
										</div>	
										<div class="form-group">
											<label>Stock Barang</label>
											<input type="text" name="qty" class="form-control" placeholder="stock barang" value="<?php echo $editData['qty']; ?>">
										</div>		
										<div class="form-group">
											<label>Harga Barang</label>
											<input type="text" name="harga" class="form-control" placeholder="harga barang" value="<?php echo $editData['harga']; ?>">
										</div>								
										<div class="form-group">
											<input type="submit" name="edit" class="btn btn-primary mt-5" value="Simpan">
										</div>
									</form>
								<?php else: ?>
									<!-- Diisi form tambah Menu -->
									<form method="post">
										<div class="form-group">
											<label>Kategori Barang</label>
											<select type="id_barang" name="id_barang" class="form-control">
												<option value="">--pilih kategori--</option>
												<!-- LOOPING -->
												<?php  while($rowkategori = mysqli_fetch_assoc($kategori)) { ?>
													<option value="<?php echo $rowkategori['id']?>"><?php echo $rowkategori['kategori']; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label>Nama barang</label>
											<input type="nama_barang" name="nama_barang" class="form-control" placeholder="nama barang">
										</div>	
										<div class="form-group">
											<label>qty</label>
											<input type="number" name="qty" class="form-control" placeholder="stock barang">
										</div>		
										<div class="form-group">
											<label>Harga Barang</label>
											<input type="number" name="harga" class="form-control" placeholder="harga barang">
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

