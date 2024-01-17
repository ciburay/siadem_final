<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
	$id_karyawan = $_POST['id_karyawan'];
	$nama = $_POST['nama'];
	$waktu = $_POST['waktu'];
	$lokasi = $_POST['lokasi'];

	// Ambil hari saat ini
	$hari_saat_ini = date('w'); // 0 (Minggu) sampai 6 (Sabtu)

	// Ambil jam saat ini
	$jam_saat_ini = date('H:i');

	// Cek apakah hari ini adalah Minggu dan waktu absen sesuai dengan kriteria
	if ($hari_saat_ini == 0) { // Minggu
		if (($jam_saat_ini >= '05:40' && $jam_saat_ini <= '07:50') || ($jam_saat_ini >= '15:30' && $jam_saat_ini <= '16:30')) {
			// Jika kriteria terpenuhi, simpan data absen
			$save = "INSERT INTO tb_absen SET id_karyawan='$id_karyawan', nama='$nama', waktu='$waktu', lokasi='$lokasi'";
			mysqli_query($koneksi, $save);

			if ($save) {
				echo "<script>alert('Anda sudah absen untuk hari ini') </script>";
				echo "<script>window.location.href = \"index.php?m=awal\" </script>";	
			} else {
				echo "Terjadi kesalahan saat menyimpan absen.";
			}
		} else {
			echo "<script>alert('Anda hanya bisa absen pada waktu yang ditentukan') </script>";
			echo "<script>window.location.href = \"index.php?m=awal\" </script>";
		}
	} else {
		echo "<script>alert('Hari ini bukan hari Minggu. Anda tidak dapat absen hari ini.') </script>";
		echo "<script>window.location.href = \"index.php?m=awal\" </script>";
	}
} else {
	echo "Tidak ada data yang dikirimkan melalui form.";
}
?>
