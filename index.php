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
                <li><i class="fa fa-home"></i><a href="index.php"> Alternatif Kos</a></li>
              </ol>
            </div>
          </div>

          <!--START SCRIPT INSERT-->
          <?php
          include 'koneksi.php';

          if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $pengembang = $_POST['pengembang']; // sekarang = Pemilik Kos
            $kategori = $_POST['kategori'];     // sekarang = Tipe Kos

            if (($nama == "") or ($pengembang == "")) {
              echo "<script>alert('Tolong Lengkapi Data Kos!');</script>";
            } else {
              $sql = "SELECT * FROM saw_aplikasi WHERE nama='$nama'";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;

              if ($rows > 0) {
                echo "<script>alert('Kos $nama Sudah Ada!');</script>";
              } else {
                $sql = "INSERT INTO saw_aplikasi(nama,pengembang,kategori)
                VALUES ('$nama','$pengembang','$kategori')";
                $hasil = $conn->query($sql);
                echo "<script>alert('Data Kos Berhasil Ditambahkan!');</script>";
              }
            }
          }
          ?>
          <!-- END SCRIPT INSERT-->

          <!--start inputan-->
          <form method="POST" action="">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Kos</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="nama">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Pemilik Kos</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="pengembang">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tipe Kos</label>
              <div class="col-sm-5">
                <select class="form-control" name="kategori">
                  <option>Putra</option>
                  <option>Putri</option>
                  <option>Campur</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <button type="submit" name="submit" class="btn btn-outline-primary">
                <i class="fa fa-save"></i> Submit
              </button>
            </div>
          </form>

          <!-- TABEL DATA KOS -->
          <table class="table">
            <thead>
              <tr>
                <th><i class="fa fa-arrow-down"></i> No</th>
                <th><i class="fa fa-arrow-down"></i> Nama Kos</th>
                <th><i class="fa fa-arrow-down"></i> Pemilik Kos</th>
                <th><i class="fa fa-arrow-down"></i> Tipe Kos</th>
                <th><i class="fa fa-cogs"></i> Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $b = 0;
              $sql = "SELECT * FROM saw_aplikasi ORDER BY nama ASC";
              $hasil = $conn->query($sql);
              $rows = $hasil->num_rows;

              if ($rows > 0) {
                while ($row = $hasil->fetch_row()) {
              ?>
                  <tr>
                    <td><?php echo $b = $b + 1; ?></td>
                    <td><?= $row[0] ?></td>
                    <td><?= $row[1] ?></td>
                    <td><?= $row[2] ?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-success" href="alt_ubah.php?nama=<?= $row[0] ?>"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger" href="alt_hapus.php?nama=<?= $row[0] ?>"><i class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
              <?php
                }
              } else {
                echo "<tr>
                    <td colspan='5'>Data Kos Tidak Ada</td>
                </tr>";
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
