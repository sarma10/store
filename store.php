<?php 
session_start();

// jika session ada dia bisa masuk ke halaman home, jika tidak ada kita lempar ke halaman login

if (empty($_SESSION['username'])) {
	header("location:index.php?login=access");
}

include 'koneksi.php';
// tampilkan seluruh data dari table user dimana urutannya dari yang terbesar ke terkecil

$query = mysqli_query($koneksi, "SELECT tbl_kategori.kategori AS kategori, tbl_barang.* FROM tbl_barang LEFT JOIN tbl_kategori ON tbl_barang.id_barang = tbl_kategori.id order by tbl_barang.id DESC");


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





			<div class="container d-flex align-content-center flex-wrap mt-5" align="center">
				<div class="row ">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<div class="card-title">
									<h3>Data Store</h3>
								</div>
								<div align="right">
									<a href="tambah-store.php" class="btn btn-primary mb-3">Tambah</a>
								</div>

								<div class="table-responsive">
									<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Jenis </th>
												<th>Stock</th>
												<th>Harga</th>
												<th>Dibuat</th>
												<th>Tindakan</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; while($row = mysqli_fetch_assoc($query)){ ?>
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $row['nama_barang'] ?></td>
													<td><?php echo $row['kategori'] ?></td>
													<td><?php echo $row['qty'] ?></td>
													<td><?php echo $row['harga'] ?></td>
													<td><?php echo $row['create_at'] ?></td>
													<td>
														<a href="tambah-store.php?edit=<?php echo $row['id']; ?>">Edit</a> | <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="tambah-store.php?delete=<?php echo $row['id'] ?>">Hapus</a>

													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('inc/footer.php') ?>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	</body>
	</html>

