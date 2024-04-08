<?php
    // Kode Program untuk mengkoneksikan ke DB, Daftar Supplier, Daftar Barang, dan Mutasi Barang.
	include_once 'koneksi.php';
	$barang = mysqli_query($koneksi, "SELECT * FROM m_item");
	$banyakbarang = mysqli_num_rows($barang);

	$supplier = mysqli_query($koneksi, "SELECT * FROM m_supplier");
	$banyaksupplier = mysqli_num_rows($supplier);

	$mutasi = mysqli_query($koneksi, "SELECT * FROM m_mutasi");
	$banyakmutasi = mysqli_num_rows($mutasi);


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Warehouse Management System - Supplier | Prodect | Delivery</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-white">
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  	</button>
		  	<a class="navbar-brand" href="#"><img src="assets/img/warehouse.png" alt="" style="max-width: 55px;"></a>
		  	<div class="collapse navbar-collapse" id="navbar">
            
            <!-- Ini Kodingan Navbar (Navigation Bar) -->
		    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		      		<li class="nav-item active">
		        		<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link" href="supplier.php">Supplier Data</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link" href="barang.php">Product Data</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link" href="mutasi.php">Delivery Data</a>
		      		</li>
		    	</ul>
		  	</div>
		</nav>
		<br><br>

        <!-- Ini Kodingan Untuk Kasih Penjelasan Fitur Apa Saja didalam Aplikasi Website ini -->
		<div class="container">
			<div class="card-group">
			  <div class="card">
			    <img class="card-img-top" src="assets/img/barang.gif" alt="Card image cap" style="max-width: 700px; margin: auto; margin-top:20px;">
			    <div class="card-body">
			      <h5 class="card-title" align="center">Product Data</h5>
			      <p class="card-text">this menu contains a list of item and CRUD item menu. Total number of items currently avilable <b><?php echo $banyakbarang; ?> Product</b></p>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" src="assets/img/supplier.gif" alt="Card image cap" style="max-width: 700px; margin: auto; margin-top:20px;">
			    <div class="card-body">
			      <h5 class="card-title" align="center">Supplier Data</h5>
			      <p class="card-text">this menu contains a list of suppliers and CRUD supplier menu. many registered number of <b><?php echo $banyaksupplier; ?> Supplier</b></p>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" src="assets/img/mutasi.gif" alt="Card image cap" style="max-width: 700px; margin: auto; margin-top:20px;">
			    <div class="card-body">
			      <h5 class="card-title" align="center">Delivery Data</h5>
			      <p class="card-text">this menu is a mutation menu where data on the release of Delivery is recorded total number of carried out <b><?php echo $banyakmutasi; ?> Deliveried</b></p>
			    </div>
			  </div>
			</div>
		</div>

		<!-- Ini Kodingan Footer -->
		<div class="container-fluid  fixed-bottom bg-light" style=" color: #999;">
			<div class="row">
				<div class="col-sm-12">
					<p align="center">&copy; DevOps CICD project of WMS @2024.</p>
				</div>
			</div>
		</div>
	
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/popper.js"></script>
		<script src="assets/js/script.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>
<script>
        // Blokir klik kanan
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            alert("Klik kanan dinonaktifkan!");
        });

        // Blokir tombol pintas inspect element
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
                e.preventDefault();
                alert("Inspect Element dinonaktifkan!");
            }
        });
</script>