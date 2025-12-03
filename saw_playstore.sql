CREATE DATABASE IF NOT EXISTS saw_playstore;
USE saw_playstore;

-- =========================
-- TABEL DATA KOS
-- =========================
CREATE TABLE `saw_aplikasi` (
  `nama` varchar(100) NOT NULL,
  `pengembang` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `saw_aplikasi` (`nama`, `pengembang`, `kategori`) VALUES
('Kos Mawar', 'Pak Budi', 'Putri'),
('Kos Melati', 'Bu Sari', 'Putra'),
('Kos Anggrek', 'Pak Joko', 'Campur');

-- =========================
-- TABEL BOBOT KRITERIA
-- =========================
CREATE TABLE `saw_kriteria` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `peringkat` float NOT NULL,
  `ukuran` float NOT NULL,
  `unduhan` float NOT NULL,
  `aktif` float NOT NULL,
  `manfaat` float NOT NULL,
  `kelebihan` float NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `saw_kriteria`
(`peringkat`, `ukuran`, `unduhan`, `aktif`, `manfaat`, `kelebihan`)
VALUES
(0.25, 0.15, 0.15, 0.15, 0.15, 0.15);

-- =========================
-- TABEL PENILAIAN KOS
-- =========================
CREATE TABLE `saw_penilaian` (
  `nama` varchar(100) NOT NULL,
  `peringkat` float NOT NULL,
  `ukuran` float NOT NULL,
  `unduhan` float NOT NULL,
  `aktif` float NOT NULL,
  `manfaat` float NOT NULL,
  `kelebihan` float NOT NULL,
  PRIMARY KEY (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `saw_penilaian`
(`nama`, `peringkat`, `ukuran`, `unduhan`, `aktif`, `manfaat`, `kelebihan`)
VALUES
('Kos Mawar', 4, 2, 5, 4, 4, 4),
('Kos Melati', 3, 3, 4, 3, 3, 3),
('Kos Anggrek', 5, 1, 5, 5, 5, 5);

-- =========================
-- TABEL PERANKINGAN
-- =========================
CREATE TABLE `saw_perankingan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nilai_akhir` float NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
