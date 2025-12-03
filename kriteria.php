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
                <li><i class="fa fa-sticky-note"></i><a href="kriteria.php"> Kriteria Pemilihan Kos</a></li>
              </ol>
            </div>
          </div>

          <!-- ================= SCRIPT HITUNG BOBOT ================= -->
          <script>
            function fungsiku() {
              var a = (document.getElementById("peringkat_param").value).substring(0, 1);
              var b = (document.getElementById("ukuran_param").value).substring(0, 1);
              var c = (document.getElementById("unduhan_param").value).substring(0, 1);
              var d = (document.getElementById("aktif_param").value).substring(0, 1);
              var e = (document.getElementById("manfaat_param").value).substring(0, 1);
              var f = (document.getElementById("kelebihan_param").value).substring(0, 1);

              var total = Number(a) + Number(b) + Number(c) + Number(d) + Number(e) + Number(f);

              document.getElementById("peringkat").value = (Number(a) / total).toFixed(2);
              document.getElementById("ukuran").value = (Number(b) / total).toFixed(2);
              document.getElementById("unduhan").value = (Number(c) / total).toFixed(2);
              document.getElementById("aktif").value = (Number(d) / total).toFixed(2);
              document.getElementById("manfaat").value = (Number(e) / total).toFixed(2);
              document.getElementById("kelebihan").value = (Number(f) / total).toFixed(2);
            }
          </script>

          <!-- ================= SCRIPT INSERT ================= -->
          <?php
          include 'koneksi.php';

          if (isset($_POST['submit'])) {
            $peringkat = $_POST['peringkat'];   // Harga
            $ukuran = $_POST['ukuran'];         // Jarak
            $unduhan = $_POST['unduhan'];       // Fasilitas
            $aktif = $_POST['aktif'];           // Keamanan
            $manfaat = $_POST['manfaat'];       // Kebersihan
            $kelebihan = $_POST['kelebihan'];   // Kenyamanan

            if (
              ($peringkat == "") or
              ($ukuran == "") or
              ($unduhan == "") or
              ($aktif == "") or
              ($manfaat == "") or
              ($kelebihan == "")
            ) {
              echo "<script>alert('Tolong Lengkapi Semua Bobot Kriteria Kos!');</script>";
            } else {
              $sql = "SELECT * FROM saw_kriteria";
              $hasil = $conn->query($sql);

              if ($hasil->num_rows > 0) {
                echo "<script>alert('Hapus Bobot Lama untuk Membuat Bobot Baru');</script>";
              } else {
                $sql = "INSERT INTO saw_kriteria (
                  peringkat, ukuran, unduhan, aktif, manfaat, kelebihan)
                VALUES (
                  '$peringkat',
                  '$ukuran',
                  '$unduhan',
                  '$aktif',
                  '$manfaat',
                  '$kelebihan')";

                $conn->query($sql);
                echo "<script>alert('Bobot Kriteria Kos Berhasil Disimpan!');</script>";
              }
            }
          }
          ?>

          <!-- ================= FORM INPUT BOBOT ================= -->
          <form class="form-validate form-horizontal" method="post" action="">

            <div class="form-group row">
              <label class="col-sm-2 col-form-label"><b>Kriteria</b></label>
              <div class="col-sm-3"><label><b>Bobot</b></label></div>
              <div class="col-sm-2"><label><b>Normalisasi</b></label></div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Harga Kos</label>
              <div class="col-sm-3">
                <select class="form-control" name="peringkat_param" id="peringkat_param">
                  <option>1. Sangat Murah</option>
                  <option>2. Murah</option>
                  <option>3. Cukup</option>
                  <option>4. Mahal</option>
                  <option>5. Sangat Mahal</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="peringkat" id="peringkat">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jarak Kos ke Kampus</label>
              <div class="col-sm-3">
                <select class="form-control" name="ukuran_param" id="ukuran_param">
                  <option>1. Sangat Jauh</option>
                  <option>2. Jauh</option>
                  <option>3. Cukup</option>
                  <option>4. Dekat</option>
                  <option>5. Sangat Dekat</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="ukuran" id="ukuran">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Fasilitas</label>
              <div class="col-sm-3">
                <select class="form-control" name="unduhan_param" id="unduhan_param">
                  <option>1. Sangat Buruk</option>
                  <option>2. Buruk</option>
                  <option>3. Cukup</option>
                  <option>4. Bagus</option>
                  <option>5. Sangat Bagus</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="unduhan" id="unduhan">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Keamanan</label>
              <div class="col-sm-3">
                <select class="form-control" name="aktif_param" id="aktif_param">
                  <option>1. Sangat Tidak Aman</option>
                  <option>2. Tidak Aman</option>
                  <option>3. Cukup</option>
                  <option>4. Aman</option>
                  <option>5. Sangat Aman</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="aktif" id="aktif">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kebersihan</label>
              <div class="col-sm-3">
                <select class="form-control" name="manfaat_param" id="manfaat_param">
                  <option>1. Sangat Kotor</option>
                  <option>2. Kotor</option>
                  <option>3. Cukup</option>
                  <option>4. Bersih</option>
                  <option>5. Sangat Bersih</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="manfaat" id="manfaat">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kenyamanan</label>
              <div class="col-sm-3">
                <select class="form-control" name="kelebihan_param" id="kelebihan_param">
                  <option>1. Sangat Tidak Nyaman</option>
                  <option>2. Tidak Nyaman</option>
                  <option>3. Cukup</option>
                  <option>4. Nyaman</option>
                  <option>5. Sangat Nyaman</option>
                </select>
              </div>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="kelebihan" id="kelebihan">
              </div>
              <div class="col-sm-2">
                <button class="btn btn-outline-success" type="button" onclick="fungsiku()">
                  <i class="fa fa-calculator"></i> Hitung
                </button>
              </div>
            </div>

            <div class="mb-4">
              <button class="btn btn-outline-primary" type="submit" name="submit">
                <i class="fa fa-save"></i> Simpan Bobot
              </button>
            </div>

          </form>

          <!-- ================= TABEL DATA BOBOT ================= -->
          <table class="table">
            <thead>
              <tr>
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
              $sql = "SELECT * FROM saw_kriteria";
              $hasil = $conn->query($sql);

              if ($hasil->num_rows > 0) {
                while ($row = $hasil->fetch_row()) {
              ?>
                  <tr>
                    <td align="center"><?= $row[1] ?></td>
                    <td align="center"><?= $row[2] ?></td>
                    <td align="center"><?= $row[3] ?></td>
                    <td align="center"><?= $row[4] ?></td>
                    <td align="center"><?= $row[5] ?></td>
                    <td align="center"><?= $row[6] ?></td>
                    <td>
                      <a class="btn btn-danger" href="kriteria_hapus.php?id=<?= $row[0] ?>">
                        <i class="fa fa-close"></i>
                      </a>
                    </td>
                  </tr>
              <?php }
              } else {
                echo "<tr><td colspan='7'>Data Tidak Ada</td></tr>";
              } ?>
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
