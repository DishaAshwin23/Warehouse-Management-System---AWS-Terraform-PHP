<?php

	include_once 'koneksi.php';
	if(isset($_COOKIE['sukses']))
	{
		echo '<script type="text/javascript">
			alert('.$_COOKIE["sukses"].')
			</script>';
	}
	$supplier 	= mysqli_query($koneksi,"SELECT * FROM m_supplier");
	$barang 	= mysqli_query($koneksi,"SELECT * FROM m_item");


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
        $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
    
        $query = "SELECT * FROM m_item WHERE 1=1";
    
        if (!empty($start_date) && !empty($end_date)) {
            // Ubah format tanggal untuk cocok dengan format di database (YYYY-MM-DD)
            $start_date_formatted = date("Y-m-d", strtotime($start_date));
            $end_date_formatted = date("Y-m-d", strtotime($end_date));
            $query .= " AND item_date BETWEEN ? AND ?";
        }
    
        if (!empty($search)) {
            $query .= " AND (item_code LIKE ? OR workshop_name LIKE ? OR item_name LIKE ?)";
        }
    
        $stmt = mysqli_prepare($koneksi, $query);
    
        if (!empty($start_date) && !empty($end_date)) {
            mysqli_stmt_bind_param($stmt, "ss", $start_date_formatted, $end_date_formatted);
        }
    
        if (!empty($search)) {
            $searchParam = "%" . $search . "%";
            mysqli_stmt_bind_param($stmt, "sss", $searchParam, $searchParam, $searchParam);
        }
    
        mysqli_stmt_execute($stmt);
        $barang = mysqli_stmt_get_result($stmt);
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
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'barang.php') echo 'active'; ?>">
                <a class="nav-link" href="barang.php">Product Data <?php if(basename($_SERVER['PHP_SELF']) == 'barang.php') echo '<span class="sr-only">(current)</span>'; ?></a>
            </li>
		    <li class="nav-item">
		        <a class="nav-link" href="mutasi.php">Delivery Data</a>
		    </li>
            <li>
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
</nav>s
		<br><br>

		<div class="container">
			<table class="table" style="border-top:#56DE2F 4px solid;">
			  <thead class="thead">
			    <tr>
			      <th scope="col">No</th>
			      <th scope="col">Part Number</th>
                  <th scope="col">Warehouse Name</th>
			      <th scope="col">Product name</th>
			      <th scope="col">Quantity of product</th>
                  <th scope="col">Unit of product</th>
                  <th scope="col">Date of entry</th>
                  <!-- <th scope="col">Nomor Polisi</th> -->
			      <th scope="col">Price</th>
                  <th scope="col">Information</th>
			      <th scope="col">Add <a type="button" class="btn btn-sm ml-2" href="javascript:void(0)" onclick="modal_barang()" style="background-color: #CD853F"><i class="fa fa-plus" style="color: #fff"></i></a></th>
			    </tr>
			  </thead>

			  <tbody>
			  	<?php $no=1; foreach($barang as $databarang) { ?>
                <!-- Kodingan Tambah Barang -->
			    <tr>
			      <th scope="row"><?php echo $no; ?></th>
			      <td><?php echo $databarang['item_code']; ?></td>
                  <td><?php echo $databarang['workshop_name']; ?></td>
			      <td><?php echo $databarang['item_name']; ?></td>
			      <td id="tablequantity"><?php echo $databarang['item_quantity']; ?></td>
                  <td><?php echo $databarang['item_satuan']; ?></td>
                  <td><?php echo $databarang['item_date']; ?></td>
			      <td><?php echo $databarang['item_price']; ?></td>
                  <td><?php echo $databarang['information']; ?></td>

                  <!-- Kodingan Button Edit Barang, Hapus Barang, Mutasi Barang -->
			      <td>
			      	<a href="javascript:void(0)" onclick="edit_barang('<?php echo $databarang['item_id']?>')" class="btn btn-sm bg-warning" title="Edit"><i class="fa fa-pencil" style="color: #fff"></i></a>
			      	<a href="processbarang.php?do=delete&id=<?php echo $databarang['item_id']?>" class="btn btn-sm bg-danger" title="delete"><i class="fa fa-trash" style="color: #fff"></i></a>
			      	<a href="javascript:void(0)" onclick="mutasi_barang('<?php echo $databarang['item_id']?>')" class="btn btn-sm bg-primary" title="Delivery"><i class="fa fa-truck" style="color: #fff"></i></a>
			      </td>
			    </tr>
			    <?php $no++;} ?>
			  </tbody>
			</table>
		</div>


        <!-- Ini Kodingan Footer -->
		<div class="container-fluid  fixed-bottom bg-light" style=" color: #999;">
			<div class="row">
				<div class="col-sm-12">
					<p align="center">&copy; DevOps CICD project of WMS @2024.</p>
				</div>
			</div>
		</div>

        <!-- Kodingan Tambah Data -->
		<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="formjudul">Add Items</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

              <!-- Ini Kodingan Barang Masuk -->      
              <!-- Kodingan Part Number Masuk -->
		      <div class="modal-body">
		        <form action="processbarang.php?do=add" method="POST" id="formbarang">
		        	<div class="form-group row">
		        		<label for="kodebarang" class="col-sm-4 col-form-label">Part Number</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Part Number" id="kodebarang" name="kodebarang">
		        		</div>
		        	</div>

                    <!-- Kodingan Nama Bengkel Masuk -->
		        	<div class="form-group row">
		        		<label for="namabarang" class="col-sm-4 col-form-label">Workshop Name</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Workshop Name" id="workshop_name" name="workshop_name">
		        		</div>
		        	</div>

                <!-- Kodingan Nama Barang Masuk -->
		        	<div class="form-group row">
		        		<label for="namabarang" class="col-sm-4 col-form-label">Name of goods</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Name of goods" id="namabarang" name="namabarang">
		        		</div>
		        	</div>

                <!-- Kodingan Stock Quantity Masuk -->
		        	<div class="form-group row">
		        		<label for="quantity" class="col-sm-4 col-form-label">Quantity Stock</label>
		        		<div class="col-sm-8">
		        			<input type="number" class="form-control" placeholder="Quantity Stock" id="quantity" name="quantity">
		        		</div>
		        	</div>
                
                <!-- Kodingan Satuan Quantity Masuk -->
		        	<div class="form-group row">
		        		<label for="satuanbarang" class="col-sm-4 col-form-label">Unit of Goods</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Unit of Goods" id="satuanbarang" name="satuanbarang">
		        		</div>
		        	</div>

                <!-- Kodingan Tanggal Barang Masuk -->
		        	<div class="form-group row">
		        		<label for="tanggalmasuk" class="col-sm-4 col-form-label">date of entry</label>
		        		<div class="col-sm-8">
		        			<input type="date" class="form-control" id="date of entry" name="tanggalmasuk">
		        		</div>
		        	</div>

                    <!-- Kodingan Nomor Polisi Masuk Dikomentar/Dinonaktifkan jika sewaktu-waktu dibutuhkan dan di DB tinggal ditambah Row Baru
                    <div class="form-group row">
		        		<label for="police_number" class="col-sm-4 col-form-label">Nomer Polisi</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Nomer Polisi" id="police_number" name="police_number">
		        		</div>
		        	</div> -->

                <!-- Kodingan Harga Masuk -->
		        	<div class="form-group row">
		        		<label for="harga" class="col-sm-4 col-form-label">price</label>
		        		<div class="col-sm-8">
		        			<input type="number" class="form-control" placeholder="price" id="harga" name="harga">
		        		</div>
		        	</div>

                <!-- Kodingan Keterangan Masuk -->
                    <div class="form-group row">
		        		<label for="information" class="col-sm-4 col-form-label">Information</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Information" id="information" name="information">
		        		</div>
		        	</div>

                <!-- Kodingan Supplier Jangan Diaktifkan, Krn Kalau Diaktifkan Nanti Bakal Crash Program -->
		        	<!-- <div class="form-group row">
		        		<label for="supplier" class="col-sm-4 col-form-label">Supplier</label>
		        		<div class="col-sm-8">
		        			<select name="supplier" id="supplier" class="form-control">
                                
		        				<?php
                                /*
		        					foreach($supplier as $supplierdata){
		        						echo '<option value="'.$supplierdata['supplier_id'].'">'.$supplierdata['supplier_name'].'</option>';
		        					}
                                    */
		        				?>
		        			</select>
		        		</div>
		        	</div> -->
		      </div>

              <!-- Ini Kodingan Save Changes -->
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Save changes</button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>


        <!-- Ini Kodingan Barang Keluar -->
        <div class="modal fade" id="formmutasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="formtitle">Goods Movement</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
              <!-- Ini Kodingan ID Barang -->
		      <div class="modal-body">
		        <form action="processmutasi.php?do=add" method="POST" id="formmutasiform">
		        	<div class="form-group row">
		        		<label for="kodemutasibarang" class="col-sm-4 col-form-label">Item ID</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Item ID" id="kodemutasibarang" name="kodemutasibarang" disabled>
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Part Number -->
                    <div class="form-group row">
		        		<label for="partnumbermutasi" class="col-sm-4 col-form-label">Part Number</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Part Number" id="partnumbermutasi" name="partnumbermutasi">
		        		</div>
                    </div>

                    <!-- Ini Kodingan Nama Bengkel -->
                    <div class="form-group row">
		        		<label for="namabengkelmutasi" class="col-sm-4 col-form-label">Workshop Name</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Workshop Name" id="namabengkelmutasi" name="namabengkelmutasi">
		        		</div>
                    </div>

                    <!-- Ini Kodingan Nama Barang Keluar -->
                    <div class="form-group row">
		        		<label for="namabarangkeluarmutasi" class="col-sm-4 col-form-label">Outgoing Item Name</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Outgoing Item Name" id="namabarangkeluarmutasi" name="namabarangkeluarmutasi">
		        		</div>
                    </div>

                    <!-- Ini Kodingan Tanggal Mutasi masuk ke kategori Key = Value pada processmutasi -->
		        	<div class="form-group row">
		        		<label for="tanggalmutasi" class="col-sm-4 col-form-label">Mutation Date</label>
		        		<div class="col-sm-8">
		        			<input type="date" class="form-control" id="Mutation Date" name="tanggalmutasi">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Quantity masuk ke kategori Key = Value pada quantity -->
		        	<div class="form-group row">
		        		<label for="mutasiquantity" class="col-sm-4 col-form-label">Quantity</label>
		        		<div class="col-sm-8">
		        			<input type="number" class="form-control" placeholder="Quantity" id="mutasiquantity" name="mutasiquantity">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Satuan Barang Keluar -->
		        	<div class="form-group row">
		        		<label for="satuanbarangkeluar" class="col-sm-4 col-form-label">Unit of Goods</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Unit of Goods" id="satuanbarangkeluar" name="satuanbarangkeluar">
		        		</div>
		        	</div>

                    <!-- Ini Kodingan Keterngan Mutasi -->
		        	<div class="form-group row">
		        		<label for="keteranganmutasi" class="col-sm-4 col-form-label">Information</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Information" id="keteranganmutasi" name="keteranganmutasi">
		        		</div>
		        	</div>
		      </div>

              <!-- Ini Kodingan Save Changes -->
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
<script>
function printPage() {
  window.print();
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