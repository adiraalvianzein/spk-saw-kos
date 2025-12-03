<?php
include 'koneksi.php';

$nama = $_GET['nama'];

// Hapus dari tabel kos (saw_aplikasi)
$sql = "DELETE FROM saw_aplikasi WHERE nama='$nama'";
$hasil = $conn->query($sql);

// Hapus dari tabel penilaian
$sql = "DELETE FROM saw_penilaian WHERE nama='$nama'";
$hasil = $conn->query($sql);

// Redirect kembali ke index
echo "<script>
    alert('Data Kos Berhasil Dihapus!');
    window.location.href='index.php';
</script>";
?>
