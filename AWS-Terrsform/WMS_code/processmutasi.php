<?php

	include_once 'koneksi.php';
	
	$do = $_GET['do'];
	if($do == 'wantadd')
	{
		$id = $_GET['id'];

		$barang 	= mysqli_query($koneksi,"SELECT * FROM m_item WHERE item_id='$id'");

		if($barang)
		{
			$data = mysqli_fetch_array($barang);

			echo json_encode($data);
		}
		else
		{
			echo 'GAGAL';
		}
	}

	elseif ($do == 'add') {
		$id = $_GET['id'];

		$barang 	= mysqli_query($koneksi,"SELECT * FROM m_item WHERE item_id='$id'");
		$databarang = mysqli_fetch_array($barang);

        $partnumbermutasi       = $_POST['partnumbermutasi'];
        $namabengkelmutasi      = $_POST['namabengkelmutasi'];
        $namabarangkeluarmutasi = $_POST['namabarangkeluarmutasi'];
		$tanggalmutasi		    = $_POST['tanggalmutasi']; // Jangan Diubah, entar Baper
		$mutasiquantity		    = $_POST['mutasiquantity']; // Jangan Diubah, entar Baper
        $satuanbarangkeluar		= $_POST['satuanbarangkeluar'];
		$harga 				    = $databarang['item_price'] * $mutasiquantity; // Jangan Diubah, entar Baper
		$quantity               = $databarang['item_quantity'] - $mutasiquantity; // Jangan Diubah, entar Baper
        $keteranganmutasi       = $_POST['keteranganmutasi'];

		$mutasi = mysqli_query($koneksi, "INSERT INTO m_mutasi (mutasi_item_id,mutasi_item_code, mutasi_bengkel, mutasi_barang, mutasi_date, mutasi_quantity,mutasi_satuan, mutasi_price, mutasi_keterangan) VALUES ('$id','$partnumbermutasi', '$namabengkelmutasi', '$namabarangkeluarmutasi', '$tanggalmutasi','$mutasiquantity', '$satuanbarangkeluar', '$harga', '$keteranganmutasi')");

		if($mutasi)
		{
			$quantityupdate = mysqli_query($koneksi,"UPDATE m_item SET item_quantity='$quantity' WHERE item_id='$id'
				");
			if($quantityupdate)
			{
				setcookie("sukses", "DATA BERHASIL DITAMBAHKAN!", time() + 10, "/");
				load();
				
			}
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