<?php

	include_once 'koneksi.php';

	$do = $_GET['do'];
	if($do == 'add')
	{
		$kodebarang     = $_POST['kodebarang'];
        $workshop_name  = $_POST['workshop_name'];
        $namabarang     = $_POST['namabarang'];
		$quantity	    = $_POST['quantity'];
        $satuanbarang	= $_POST['satuanbarang'];
        $tanggalmasuk	= $_POST['tanggalmasuk'];
        // $police_number = $_POST['police_number'];
		$harga		= $_POST['harga'];
        $information = $_POST['information'];
		// $supplier	= $_POST['supplier'];

		$query = mysqli_query($koneksi, "INSERT INTO m_item (item_code, item_name, workshop_name, item_quantity, item_satuan, item_date, item_price, information) 
        VALUES ('$kodebarang', '$namabarang', '$workshop_name', '$quantity', '$satuanbarang', '$tanggalmasuk', '$harga', '$information')")
        or die(mysqli_error($koneksi));

		if($query)
		{
			setcookie("sukses", "DATA BERHASIL DITAMBAHKAN!", time() + 10, "/");
			load();
		}
		else
		{
			echo 'GAGAL';
		}
	}

	elseif ($do == 'wantedit') {
		$id = $_GET['id'];
		$barang 	= mysqli_query($koneksi,"SELECT * FROM m_item WHERE item_id='$id'");
		$data = mysqli_fetch_array($barang);
		echo json_encode($data);

	}

	elseif ($do == 'edit') {
		$id = $_GET['id'];

		$kodebarang     = $_POST['kodebarang'];
        $workshop_name  = $_POST['workshop_name'];
        $namabarang     = $_POST['namabarang'];
		$quantity	    = $_POST['quantity'];
        $satuanbarang	= $_POST['satuanbarang'];
        $tanggalmasuk	= $_POST['tanggalmasuk'];
        // $police_number = $_POST['police_number'];
		$harga		= $_POST['harga'];
        $information = $_POST['information'];

		$query = mysqli_query($koneksi, "UPDATE m_item SET item_code='$kodebarang', workshop_name='$workshop_name', item_name='$namabarang', item_quantity='$quantity', item_satuan='$satuanbarang', item_date = '$tanggalmasuk',  item_price='$harga', information='$information' WHERE item_id='$id'") or die(mysqli_error($koneksi));

		if($query)
		{
			setcookie("sukses", "DATA BERHASIL DI EDIT!", time() + 10, "/");
			load();
		}
		else
		{
			echo 'GAGAL';
		}
	}

	elseif ($do = 'delete') {
		$id = $_GET['id'];
		$query = mysqli_query($koneksi, "DELETE FROM m_item WHERE item_id='$id'") or die(mysqli_error($koneksi));
		if($query)
		{
			setcookie("sukses", "DATA BERHASIL DIHAPUS!", time() + 10, "/");
			load();
		}
		else
		{
			echo 'GAGAL';
		}
	}

	function load(){

		echo '<script type="text/javascript">
				window.location.replace("barang.php");
			 </script>';
	}

?>