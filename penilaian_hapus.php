<?php
include 'koneksi.php';

$nama = $_GET['nama'];

// Hapus data penilaian kos
$sql = "DELETE FROM saw_penilaian WHERE nama='$nama'";
$hasil = $conn->query($sql);

// Redirect kembali ke halaman penilaian
echo "<script>
    alert('Data Penilaian Kos Berhasil Dihapus!');
    window.location.href='penilaian.php';
</script>";
?>
