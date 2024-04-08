<?php

	include_once 'koneksi.php';
	if(isset($_COOKIE['sukses']))
	{
		echo '<script type="text/javascript">
			alert('.$_COOKIE["sukses"].')
			</script>';
	}
	$mutasi = mysqli_query($koneksi, "SELECT * FROM m_mutasi");
    $supplier = mysqli_query($koneksi, "SELECT * FROM m_supplier");
    $barang = mysqli_query($koneksi, "SELECT * FROM m_item");

    // Pemrosesan filter tanggal
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start_date']) && isset($_POST['end_date'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $start_date_formatted = date("Y-m-d", strtotime($start_date));
        $end_date_formatted = date("Y-m-d", strtotime($end_date));

        $query = "SELECT * FROM m_mutasi WHERE mutasi_date BETWEEN '$start_date_formatted' AND '$end_date_formatted'";
        $mutasi = mysqli_query($koneksi, $query);
    }

// Pemrosesan filter pencarian
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $search = $_POST['search'];
        $query = "SELECT * FROM m_mutasi WHERE mutasi_item_code LIKE '%$search%' OR mutasi_bengkel LIKE '%$search%' OR mutasi_barang LIKE '%$search%' OR mutasi_keterangan LIKE '%$search%'";
        $mutasi = mysqli_query($koneksi, $query);
    }

    // Penghapusan data
    if (isset($_GET['id'])) {
        $delete_id = $_GET['id'];
        $delete_query = "DELETE FROM m_mutasi WHERE mutasi_id = $delete_id";
        mysqli_query($koneksi, $delete_query);
        header("Location: mutasi.php"); // Perbaikan disini
    exit(); // Penting untuk menghentikan eksekusi script setelah melakukan redirect
    }

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
    <a class="navbar-brand" href="#"><img src="assets/img/warehouse.png" alt="" style="max-width: 55px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="supplier.php">Supplier Data</a>
            </li>
            <li class="nav-item">
		        <a class="nav-link" href="barang.php">Product Data</a>
		    </li>
		    <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'mutasi.php') echo 'active'; ?>">
                <a class="nav-link" href="mutasi.php">Delivery Data <?php if(basename($_SERVER['PHP_SELF']) == 'mutasi.php') echo '<span class="sr-only">(current)</span>'; ?></a>
            </li>
            <li class="nav-item">
                <button class="btn btn-primary" onclick="printPage()">Print</button>
            </li>
        </ul>

        <form class="form-inline" method="POST">
                    <div class="form-group mx-2">
                    <label class="mr-2">Search</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
            </div>
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
        </form>

        <form class="form-inline" method="POST">
            <div class="form-group mx-2">
                <label class="mr-2">Entry date</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="form-group mx-2">
                <label class="mr-2">End date</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        </form>
    </div>
</nav>

		<br><br>
		<div class="container">
			<table class="table" style="border-top: #56DE2F 4px solid;">
			  <thead class="thead">
			    <tr>
			      <th scope="col">No</th>
			      <!-- <th scope="col">Kode Barang</th> -->
                  <th scope="col">Part Number</th>
                  <th scope="col">Warehouse Name</th>
                  <th scope="col">Product name</th> 
			      <th scope="col">End date</th>
			      <th scope="col">Quantity</th>
                  <th scope="col">Unit</th>
			      <th scope="col">Price</th>
                  <th scope="col">Information</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $no=1; foreach($mutasi as $datamutasi) { ?>
			    <tr>
			      <th scope="row"><?php echo $no; ?></th>
			      <!-- <td><?php //echo $datamutasi['mutasi_item_id']; ?></td> -->
                  <td><?php echo $datamutasi['mutasi_item_code']; ?></td>
                  <td><?php echo $datamutasi['mutasi_bengkel']; ?></td>
                  <td><?php echo $datamutasi['mutasi_barang']; ?></td>
			      <td><?php echo $datamutasi['mutasi_date']; ?></td>
			      <td id="tablequantity"><?php echo $datamutasi['mutasi_quantity']; ?></td>
                  <td><?php echo $datamutasi['mutasi_satuan']; ?></td>
			      <td><?php echo $datamutasi['mutasi_price']; ?></td>
                  <td><?php echo $datamutasi['mutasi_keterangan']; ?></td>
                  <td>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(<?php echo $datamutasi['mutasi_id']; ?>)">Delete</button>
                  </td>
			    </tr>
			    <?php $no++;} ?>
			  </tbody>
			</table>

		</div>

		<div class="container-fluid  fixed-bottom bg-light" style=" color: #999;">
			<div class="row">
				<div class="col-sm-12">
					<p align="center">&copy; 2023 PT. CMA. ALL RIGHTS RESERVED.</p>
				</div>
			</div>
		</div>

        <!-- Ini Kodingan di mutasi.php untuk get Data dari DB -->

		<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="formjudul">Add Items</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

              <!-- Ini Kodingan di mutasi.php Untuk Ditampilkan ke User-->
		      <div class="modal-body">
		        <form action="processbarang.php?do=add" method="POST">
		        	<div class="form-group row">
		        		<label for="kodebarang" class="col-sm-4 col-form-label">Item code</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Item code" id="kodebarang" name="kodebarang">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Part Number -->
		        	<div class="form-group row">
		        		<label for="partnumber" class="col-sm-4 col-form-label">Part Number</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Part Number" id="partnumber" name="partnumber">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Nama Bengkel -->
		        	<div class="form-group row">
		        		<label for="namabengkel" class="col-sm-4 col-form-label">Workshop Name</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Workshop Name" id="namabengkel" name="namabengkel">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Nama Barang -->
		        	<div class="form-group row">
		        		<label for="namabarang" class="col-sm-4 col-form-label">Name of goods</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Name of goods" id="namabarang" name="namabarang">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Quantity -->
		        	<div class="form-group row">
		        		<label for="quantity" class="col-sm-4 col-form-label">Quantity</label>
		        		<div class="col-sm-8">
		        			<input type="number" class="form-control" placeholder="Quantity" id="quantity" name="quantity">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Quantity -->
		        	<div class="form-group row">
		        		<label for="satuanbarang" class="col-sm-4 col-form-label">Unit of Goods</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Unit of Goods" id="satuanbarang" name="satuanbarang">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Harga -->
		        	<div class="form-group row">
		        		<label for="harga" class="col-sm-4 col-form-label">Price</label>
		        		<div class="col-sm-8">
		        			<input type="number" class="form-control" placeholder="Price" id="harga" name="harga">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Keterangan Keluar -->
		        	<div class="form-group row">
		        		<label for="keterangankeluar" class="col-sm-4 col-form-label">Information</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Information" id="keterangankeluar" name="keterangankeluar">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Supplier Dinonaktifkan krn tdk dibutuhkan -->
		        	<!-- <div class="form-group row">
		        		<label for="supplier" class="col-sm-4 col-form-label">Supplier</label>
		        		<div class="col-sm-8">
		        			<select name="supplier" id="supplier" class="form-control"> -->
		        				<?php
		        					// foreach($supplier as $supplierdata){
		        					// 	echo '<option value="'.$supplierdata['supplier_id'].'">'.$supplierdata['supplier_name'].'</option>';
		        					// }
		        				?>
		        			</select>
		        		<!-- </div>
		        	</div> -->
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Save changes</button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>

		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/popper.js"></script>
		<script src="assets/js/script.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

	</body>
</html>
<!-- Ini Kodingan Function Print -->
<script>
    function printPage() {
        window.print();
    }

    function deleteRow(id) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
        if (confirmation) {
            window.location.href = "mutasi.php?id=" + id;
        }
    }

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