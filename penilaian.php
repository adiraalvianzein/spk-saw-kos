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

          <!--overview start-->
          <div class="row">
            <div class="col-lg-12">
              <ol class="breadcrumb">
                <li><i class="fa fa-list-ol"></i><a href="penilaian.php"> Penilaian Kos</a></li>
              </ol>
            </div>
          </div>

          <!-- ================= SCRIPT INSERT ================= -->
          <?php
          include 'koneksi.php';

          if (isset($_POST['submit'])) {
            $nama = $_POST['nama']; // Nama Kos
            $peringkat = $_POST['peringkat']; // Harga
            $ukuran = substr($_POST['ukuran'], 1, 1); // Jarak
            $unduhan = substr($_POST['unduhan'], 1, 1); // Fasilitas
            $aktif = substr($_POST['aktif'], 1, 1); // Keamanan
            $manfaat = substr($_POST['manfaat'], 1, 1); // Kebersihan
            $kelebihan = substr($_POST['kelebihan'], 1, 1); // Kenyamanan

            if (
              $peringkat == "" || $ukuran == "" || $unduhan == "" ||
              $aktif == "" || $manfaat == "" || $kelebihan == ""
            ) {
              echo "<script>alert('Tolong Lengkapi Semua Data Penilaian Kos!');</script>";
            } else {
              $sql = "SELECT * FROM saw_penilaian WHERE nama='$nama'";
              $hasil = $conn->query($sql);

              if ($hasil->num_rows > 0) {
                echo "<script>alert('Data Penilaian Kos $nama Sudah Ada!');</script>";
              } else {
                $sql = "INSERT INTO saw_penilaian (
                  nama, peringkat, ukuran, unduhan, aktif, manfaat, kelebihan
                ) VALUES (
                  '$nama',
                  '$peringkat',
                  '$ukuran',
                  '$unduhan',
                  '$aktif',
                  '$manfaat',
                  '$kelebihan'
                )";

                $conn->query($sql);
                echo "<script>alert('Penilaian Kos Berhasil Ditambahkan!');</script>";
              }
            }
          }
          ?>
          <!-- ================= END SCRIPT INSERT ================= -->

          <!-- ================= FORM INPUT PENILAIAN ================= -->
          <form method="POST" action="">

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Kos</label>
              <div class="col-sm-4">
                <select class="form-control" name="nama">
                  <?php
                  $sql = "SELECT * FROM saw_aplikasi";
                  $hasil = $conn->query($sql);

                  if ($hasil->num_rows > 0) {
                    while ($row = mysqli_fetch_array($hasil)) {
                  ?>
                      <option><?= $row[0]; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Harga Kos</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="peringkat">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jarak ke Kampus</label>
              <div class="col-sm-4">
                <select class="form-control" name="ukuran">
                  <option>(1) Sangat Jauh</option>
                  <option>(2) Jauh</option>
                  <option>(3) Sedang</option>
                  <option>(4) Dekat</option>
                  <option>(5) Sangat Dekat</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Fasilitas</label>
              <div class="col-sm-4">
                <select class="form-control" name="unduhan">
                  <option>(1) Sangat Buruk</option>
                  <option>(2) Buruk</option>
                  <option>(3) Cukup</option>
                  <option>(4) Baik</option>
                  <option>(5) Sangat Baik</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Keamanan</label>
              <div class="col-sm-4">
                <select class="form-control" name="aktif">
                  <option>(1) Sangat Tidak Aman</option>
                  <option>(2) Tidak Aman</option>
                  <option>(3) Cukup</option>
                  <option>(4) Aman</option>
                  <option>(5) Sangat Aman</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kebersihan</label>
              <div class="col-sm-4">
                <select class="form-control" name="manfaat">
                  <option>(1) Sangat Kotor</option>
                  <option>(2) Kotor</option>
                  <option>(3) Cukup</option>
                  <option>(4) Bersih</option>
                  <option>(5) Sangat Bersih</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kenyamanan</label>
              <div class="col-sm-4">
                <select class="form-control" name="kelebihan">
                  <option>(1) Sangat Tidak Nyaman</option>
                  <option>(2) Tidak Nyaman</option>
                  <option>(3) Cukup</option>
                  <option>(4) Nyaman</option>
                  <option>(5) Sangat Nyaman</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <button type="submit" name="submit" class="btn btn-outline-primary">
                <i class="fa fa-save"></i> Simpan Penilaian
              </button>
            </div>

          </form>

          <!-- ================= TABEL DATA PENILAIAN ================= -->
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
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $b = 0;
              $sql = "SELECT * FROM saw_penilaian ORDER BY nama ASC";
              $hasil = $conn->query($sql);

              if ($hasil->num_rows > 0) {
                while ($row = $hasil->fetch_row()) {
              ?>
                  <tr>
                    <td align="center"><?= ++$b ?></td>
                    <td><?= $row[0] ?></td>
                    <td align="center"><?= $row[1] ?></td>
                    <td align="center"><?= $row[2] ?></td>
                    <td align="center"><?= $row[3] ?></td>
                    <td align="center"><?= $row[4] ?></td>
                    <td align="center"><?= $row[5] ?></td>
                    <td align="center"><?= $row[6] ?></td>
                    <td>
                      <a class="btn btn-danger" href="penilaian_hapus.php?nama=<?= $row[0] ?>">
                        <i class="fa fa-close"></i>
                      </a>
                    </td>
                  </tr>
              <?php
                }
              } else {
                echo "<tr><td colspan='9'>Data Tidak Ada</td></tr>";
              }
              ?>
            </tbody>
          </table>

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
