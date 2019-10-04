<?php  
	$server = "localhost";
	// session_start();

	//START URL
	function url_akhir(){
		$link = explode("/",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$kembali = end($link);
		return $kembali;
	}

	function url_main(){
		global $server;
		$link = explode(url_akhir(),parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$kembali = $server.$link['0'];
		return $kembali;
	}

	function url_page($url){
		$link = explode("/",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$kembali = $link[$url];
		return $kembali;	
	}

	function url_simpan(){
		global $server;
		$_SESSION['path_url'] = $server.$_SERVER['REQUEST_URI'];
		return $_SESSION['path_url'];
	}

	function url_ambil(){
		echo $_SESSION['path_url'];
		if (!empty($_SESSION['path_url'])) {
			unset($_SESSION['path_url']);
		}
	}

	//END URL
	//START PESAN

	function pesan_buat($isi){
		$_SESSION['pesan'] = $isi;
	}

	function pesan(){
		echo $_SESSION['pesan'];
		if (!empty($_SESSION['pesan'])) {
			unset($_SESSION['pesan']);
		}
	}

	function id_buat($id){
		$_SESSION['id'] = $id;
		return "id";
	}

	function id_lihat($id){
		echo $_SESSION['id'];
		if (!empty($_SESSION[$nama])) {
			unset($_SESSION[$nama]);
		}
	}

	// END PESAN
	// START CRUD

	function query_create($data = array(), $table, $linkBerhasil, $pesan){
		$Sdata = implode(',', $data);
		$kirim = $host->query("INSERT INTO $table VALUES($Sdata)");
		if ($kirim) {
			pesan_buat("Berhasil ".$pesan);
			?><script type="text/javascript"> 
			window.location = "<?php url_main()."$linkBerhasil" ?>";
			</script><?php
		}else{
			pesan_buat("Gagal ".$pesan);
			?><script type="text/javascript"> 
			window.location = "<?php echo url_ambil() ?>";
			</script><?php
		}		
	}

	function query_delete($id, $nama_id, $table, $pesan){
		$data = $host->query("DELETE FROM $table WHERE $namaId = '$id'");
		if ($data) {
			pesan_buat("Berhasil ".$pesan);
			?><script type="text/javascript"> 
			window.location = "<?php echo url_ambil() ?>";
			</script><?php
		}else{
			pesan_buat("Gagal ".$pesan);
			?><script type="text/javascript"> 
			window.location = "<?php echo url_ambil() ?>";
			</script><?php
		}	
	}

	//END QUERY
?>
