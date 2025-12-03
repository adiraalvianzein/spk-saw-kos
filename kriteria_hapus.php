<?php
include 'koneksi.php';

$no = $_GET['id'];

// Hapus data bobot kriteria
$sql = "DELETE FROM saw_kriteria WHERE no='$no'";
$hasil = $conn->query($sql);

// Redirect kembali ke halaman kriteria
echo "<script>
    alert('Bobot Kriteria Kos Berhasil Dihapus!');
    window.location.href='kriteria.php';
</script>";
?>
