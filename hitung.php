<!doctype html>
<html lang="en">

<?php
include 'components/head.php';
?>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <?php
        include 'components/sidebar.php';
        ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <?php
            include 'components/navbar.php';
            ?>

            <section id="main-content">
                <section class="wrapper">

                    <div class="row">
                        <div class="col-lg-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-cogs"></i><a href="hitung.php"> Proses Perhitungan Kos</a></li>
                            </ol>
                        </div>
                    </div>

                    <!-- ================= MATRIX X ================= -->
                    <div>
                        <b><h6><b>MATRIX X (DATA PENILAIAN KOS)</b></h6></b>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kos</th>
                                    <th>Harga</th>
                                    <th>Jarak</th>
                                    <th>Fasilitas</th>
                                    <th>Keamanan</th>
                                    <th>Kebersihan</th>
                                    <th>Kenyamanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'koneksi.php';

                                $b = 0;
                                $sql = "SELECT * FROM saw_penilaian ORDER BY nama ASC";
                                $hasil = $conn->query($sql);

                                if ($hasil->num_rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                ?>
                                        <tr>
                                            <td align="center"><?php echo ++$b; ?></td>
                                            <td><?= $row[0] ?></td>
                                            <td align="center"><?= $row[1] ?></td>
                                            <td align="center"><?= $row[2] ?></td>
                                            <td align="center"><?= $row[3] ?></td>
                                            <td align="center"><?= $row[4] ?></td>
                                            <td align="center"><?= $row[5] ?></td>
                                            <td align="center"><?= $row[6] ?></td>
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr><td colspan='8'>Data Tidak Ada</td></tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ================= NORMALISASI ================= -->
                    <div>
                        <b><h6><b>NORMALISASI</b></h6></b>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kos</th>
                                    <th>Harga</th>
                                    <th>Jarak</th>
                                    <th>Fasilitas</th>
                                    <th>Keamanan</th>
                                    <th>Kebersihan</th>
                                    <th>Kenyamanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM saw_penilaian";
                                $hasil = $conn->query($sql);

                                if ($hasil->num_rows > 0) {
                                    $b = 0;

                                    // Benefit & Cost sesuai struktur lama
                                    $sql = "SELECT * FROM saw_penilaian ORDER BY peringkat DESC";
                                    $C1 = $conn->query($sql)->fetch_row()[1];

                                    $sql = "SELECT * FROM saw_penilaian ORDER BY ukuran ASC";
                                    $C2 = $conn->query($sql)->fetch_row()[2]; // COST

                                    $sql = "SELECT * FROM saw_penilaian ORDER BY unduhan DESC";
                                    $C3 = $conn->query($sql)->fetch_row()[3];

                                    $sql = "SELECT * FROM saw_penilaian ORDER BY aktif DESC";
                                    $C4 = $conn->query($sql)->fetch_row()[4];

                                    $sql = "SELECT * FROM saw_penilaian ORDER BY manfaat DESC";
                                    $C5 = $conn->query($sql)->fetch_row()[5];

                                    $sql = "SELECT * FROM saw_penilaian ORDER BY kelebihan DESC";
                                    $C6 = $conn->query($sql)->fetch_row()[6];
                                }

                                $sql = "SELECT * FROM saw_penilaian";
                                $hasil = $conn->query($sql);

                                if ($hasil->num_rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                ?>
                                        <tr>
                                            <td align="center"><?= ++$b ?></td>
                                            <td><?= $row[0] ?></td>
                                            <td align="center"><?= round($row[1] / $C1, 2) ?></td>
                                            <td align="center"><?= round($C2 / $row[2], 2) ?></td>
                                            <td align="center"><?= round($row[3] / $C3, 2) ?></td>
                                            <td align="center"><?= round($row[4] / $C4, 2) ?></td>
                                            <td align="center"><?= round($row[5] / $C5, 2) ?></td>
                                            <td align="center"><?= round($row[6] / $C6, 2) ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ================= NILAI PREFERENSI ================= -->
                    <div>
                        <b><h6><b>NILAI PREFERENSI</b></h6></b>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kos</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $b = 0;

                                $sql = "SELECT * FROM saw_kriteria";
                                $hasil = $conn->query($sql);
                                if ($hasil->num_rows > 0) {
                                    $row = $hasil->fetch_row();
                                    $B1 = $row[1];
                                    $B2 = $row[2];
                                    $B3 = $row[3];
                                    $B4 = $row[4];
                                    $B5 = $row[5];
                                    $B6 = $row[6];
                                }

                                $conn->query("TRUNCATE TABLE saw_perankingan");

                                $sql = "SELECT * FROM saw_penilaian";
                                $hasil = $conn->query($sql);

                                if ($hasil->num_rows > 0) {
                                    while ($row = $hasil->fetch_row()) {

                                        $nilai = round((($row[1] / $C1) * $B1) +
                                            (($C2 / $row[2]) * $B2) +
                                            (($row[3] / $C3) * $B3) +
                                            (($row[4] / $C4) * $B4) +
                                            (($row[5] / $C5) * $B5) +
                                            (($row[6] / $C6) * $B6), 3);

                                        $nama = $row[0];
                                        $conn->query("INSERT INTO saw_perankingan(nama,nilai_akhir) VALUES ('$nama','$nilai')");
                                    }
                                }

                                $sql = "SELECT * FROM saw_perankingan";
                                $hasil = $conn->query($sql);

                                if ($hasil->num_rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                ?>
                                        <tr>
                                            <td><?= ++$b ?></td>
                                            <td><?= $row[1] ?></td>
                                            <td><?= $row[2] ?></td>
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr><td colspan='3'>Data Tidak Ada</td></tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ================= PERANKINGAN ================= -->
                    <div>
                        <b><h6><b>PERANKINGAN KOS TERBAIK</b></h6></b>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kos</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $b = 0;
                                $sql = "SELECT * FROM saw_perankingan ORDER BY nilai_akhir DESC";
                                $hasil = $conn->query($sql);

                                if ($hasil->num_rows > 0) {
                                    while ($row = $hasil->fetch_row()) {
                                ?>
                                        <tr>
                                            <td><?= ++$b ?></td>
                                            <td><?= $row[1] ?></td>
                                            <td><?= $row[2] ?></td>
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr><td colspan='3'>Data Tidak Ada</td></tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>

                </section>
            </section>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
