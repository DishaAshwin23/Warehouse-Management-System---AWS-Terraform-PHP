<?php
	include_once 'koneksi.php';
	if(isset($_COOKIE['sukses']))
	{
		echo '<script type="text/javascript">
			alert('.$_COOKIE["sukses"].')
			</script>';
	}
	$supplier 	= mysqli_query($koneksi,"SELECT * FROM m_supplier");

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
		    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		      		<li class="nav-item">
		        		<a class="nav-link" href="index.php">Home</a>
		      		</li>
		      		<li class="nav-item active">
		        		<a class="nav-link" href="supplier.php">Supplier Data <span class="sr-only">(current)</span></a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link" href="barang.php">Product Data</a>
		      		</li>
		      		<li class="nav-item">
		        		<a class="nav-link" href="mutasi.php">Delivery Data</a>
		      		</li>
                    <li>
                        <button class="btn btn-primary" onclick="printPage()">Print</button>
                    </li>
		    	</ul>
		  	</div>
		</nav>
		<br><br>
		<div class="container">
			<table class="table" style="border-top: #56DE2F 4px solid;">
			  <thead class="thead">
			    <tr>
			      <th scope="col">No</th>
			      <th scope="col">Supplier Name</th>
			      <th scope="col">Contact</th>
			      <th scope="col">Address</th>
			      <th scope="col">Add <a type="button" class="btn btn-sm ml-2" href="javascript:void(0)" onclick="modal_supplier()" style="background-color: #CD853F"><i class="fa fa-plus" style="color: #fff"></i></a></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $no=1; foreach($supplier as $datasupplier) { ?>
			    <tr>
			      <th scope="row"><?php echo $no; ?></th>
			      <td><?php echo $datasupplier['supplier_name']; ?></td>
			      <td><?php echo $datasupplier['supplier_contact']; ?></td>
			      <td><?php echo $datasupplier['supplier_address']; ?></td>
			      <td>
			      	<a href="javascript:void(0)" onclick="edit_supplier('<?php echo $datasupplier['supplier_id']?>')" class="btn btn-sm bg-warning" title="Edit"><i class="fa fa-pencil" style="color: #fff"></i></a>
			      	<a href="processsupplier.php?do=delete&id=<?php echo $datasupplier['supplier_id']?>" class="btn btn-sm bg-danger" title="delete"><i class="fa fa-trash" style="color: #fff"></i></a>
			      </td>
			    </tr>
			    <?php $no++; } ?>
			  </tbody>
			</table>

		</div>

		<div class="container-fluid  fixed-bottom bg-light" style=" color: #999;">
			<div class="row">
				<div class="col-sm-12">
					<p align="center">&copy; DevOps CICD project of WMS @2024.</p>
				</div>
			</div>
		</div>

		<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="formjudul">Add Supplier</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
              <!-- Ini Kodingan Nama Supplier -->
		      <div class="modal-body">
		        <form action="processsupplier.php?do=add" method="POST">
		        	<div class="form-group row">
		        		<label for="namasupplier" class="col-sm-4 col-form-label">Name Supplier</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="Supplier Name" id="namasupplier" name="namasupplier">
		        		</div>
		        	</div>
                <!-- Ini Kodingan Kontak Supplier -->
		        	<div class="form-group row">
		        		<label for="kontaksupplier" class="col-sm-4 col-form-label">contact Supplier</label>
		        		<div class="col-sm-8">
		        			<input type="text" class="form-control" placeholder="contact Supplier" id="kontaksupplier" name="kontaksupplier">
		        		</div>
		        	</div>
                <!-- Ini Kodingan Alamat Supplier -->
		        	<div class="form-group row">
		        		<label for="alamat" class="col-sm-4 col-form-label">Address</label>
		        		<div class="col-sm-8">
		        			<textarea name="alamat" id="alamat" class="form-control"></textarea>
		        		</div>
		        	</div>
		      </div>
              <!-- Ini Kodingan Save Button -->
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