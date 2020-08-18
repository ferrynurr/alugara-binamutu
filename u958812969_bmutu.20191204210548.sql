-- MySQL dump 10.16  Distrib 10.2.27-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u958812969_bmutu
-- ------------------------------------------------------
-- Server version	10.2.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kuisioner`
--

DROP TABLE IF EXISTS `kuisioner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuisioner` (
  `id_kuisioner` int(11) NOT NULL AUTO_INCREMENT,
  `id_aspek` int(11) NOT NULL,
  `id_pembinaan` int(11) NOT NULL,
  `mn` varchar(11) DEFAULT NULL,
  `mj` varchar(11) DEFAULT NULL,
  `sr` varchar(11) DEFAULT NULL,
  `kr` varchar(11) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `tgl_tindak_lanjut` date NOT NULL,
  PRIMARY KEY (`id_kuisioner`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuisioner`
--

/*!40000 ALTER TABLE `kuisioner` DISABLE KEYS */;
/*!40000 ALTER TABLE `kuisioner` ENABLE KEYS */;

--
-- Table structure for table `kuisioner_aspek`
--

DROP TABLE IF EXISTS `kuisioner_aspek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuisioner_aspek` (
  `id_aspek` int(11) NOT NULL AUTO_INCREMENT,
  `id_klausul` int(11) NOT NULL,
  `nama_aspek` text NOT NULL,
  `mn` text NOT NULL,
  `mj` text NOT NULL,
  `sr` text NOT NULL,
  `kr` text NOT NULL,
  PRIMARY KEY (`id_aspek`),
  KEY `id_klausul` (`id_klausul`),
  CONSTRAINT `kuisioner_aspek_ibfk_1` FOREIGN KEY (`id_klausul`) REFERENCES `kuisioner_klausul` (`id_klausul`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuisioner_aspek`
--

/*!40000 ALTER TABLE `kuisioner_aspek` DISABLE KEYS */;
INSERT INTO `kuisioner_aspek` VALUES (1,1,'MANAJEMEN','false','false','true','true'),(2,2,'LOKASI AREA UPI','true','false','false','true'),(3,3,'PINTU','false','true','true','true'),(4,3,'LANTAI','true','false','false','true'),(5,3,'DINDING','false','false','true','true'),(6,3,'LANGIT-LANGIT/ATAP','true','false','false','true'),(7,3,'JENDELA/BAGIAN YANG DAPAT DIBUKA','false','true','true','true'),(8,3,'VENTILASI','true','true','false','false'),(9,3,'PENERANGAN','true','true','true','false'),(10,3,'SALURAN PEMBUANGAN','true','false','true','true'),(11,3,'TEMPAT PENYIMPANAN BAHAN KIMIA','true','false','true','true'),(12,4,'PENATAAN DAN PENEMPATAN ALAT','false','true','true','true'),(13,4,'PEMBERSIHAN DAN DISINFEKSI','true','false','true','true'),(14,5,'PERSYARATAN DAN PENGGUNAAN BAHAN BAKU DAN TAMBAHAN','false','false','true','true'),(15,5,'PENERIMAAN BAHAN BAKU','true','false','true','true'),(16,5,'BAHAN PENGEMAS,PEMBUNGKUS, DAN LABEL','true','false','false','true'),(17,6,'SUHU PENANGANAN PRODUK SEGAR, MENTAH DAN MASAK YANG DIDINGINKAN','true','false','false','true'),(18,6,'SUHU PENYIMPANAN PRODUK BEKU','true','false','true','true'),(19,6,'SUHU PENYIMPANAN PRODUK STERILISASI','false','true','true','true'),(20,6,'SUHU PENYIMPANAN PRODUK PASTEURISASI','true','true','true','false'),(21,6,'CARA PENYIMPANAN PRODUK LAINNYA','false','true','true','true'),(22,7,'IPAL','false','true','true','true'),(23,8,'PERSYARATAN AIR','true','true','true','false'),(24,8,'SALURAN PIPA AIR','true','true','false','true'),(25,8,'PENGGUNAAN AIR LAUT','true','true','false','true'),(26,8,'ES','true','true','true','false'),(27,9,'BAHAN DAN DESAIN','true','false','false','true'),(28,9,'TANDA DAN PENGGUNAAN ALAT','false','true','true','true'),(29,10,'DESAIN DAN FASILITAS PENCUCIAN','false','false','true','true'),(30,10,'PASOKAN AIR PENCUCIAN','true','false','true','true'),(31,11,'KONSTRUKSI UPI','true','false','true','true'),(32,11,'TATA LETAK DAN ALUR PROSES UPI','true','true','false','true'),(33,11,'RUANGAN UNIT PROSES','true','false','true','true'),(34,12,'KONDISI RUANG DAN PERALATAN PENGOLAHAN','true','false','true','true'),(35,12,'KETERSEDIAAN PERALATAN KEBERSIHAN','false','true','true','true'),(36,13,'BAK CUCI KAKI','false','true','true','true'),(37,13,'TEMPAT CUCI TANGAN','true','false','false','true'),(38,13,'RUANG GANTI PAKAIAN KARYAWAN','false','true','true','true'),(39,13,'TOILET','true','true','true','false'),(40,13,'PERLENGKAPAN SANITASI TOILET','true','true','false','true'),(41,13,'TANDA PERINGATAN BAGI KARYAWAN TENTANG CARA MELAKUKAN PENGOLAHAN YANG BAIK','false','true','true','true'),(42,14,'PEMBERIAN LABEL DAN PENYIMPANAN BAHAN KIMIA BERBAHAYA','false','true','true','true'),(43,14,'PENGGUNAAN BAHAN KIMIA DAN BAHAN BERBAHAYA','false','true','true','true'),(44,15,'PENANGANAN LIMBAH','false','true','true','true'),(45,15,'TEMPAT PENAMPUNGAN LIMBAH','false','true','true','true'),(46,16,'CARA PENGEMASAN','false','false','true','true'),(47,16,'PENYIMPANAN BAHAN PENGEMAS','false','true','true','true'),(48,16,'PEMBERIAN LABEL PADA KEMASAN','false','true','true','true'),(49,17,'PAKAIAN KERJA DAN KEBERSIHAN KARYAWAN','true','false','true','true'),(50,17,'KESEHATAN KARYAWAN','true','true','false','true'),(51,18,'ADA PROGRAM PENINGKATAN KEMAMPUAN/KETERAMPILAN','true','false','true','true'),(52,19,'FASILITAS PENGENDALIAN BINATANG PENGGANGGU','true','true','false','true');
/*!40000 ALTER TABLE `kuisioner_aspek` ENABLE KEYS */;

--
-- Table structure for table `kuisioner_klausul`
--

DROP TABLE IF EXISTS `kuisioner_klausul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuisioner_klausul` (
  `id_klausul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_klausul` text NOT NULL,
  PRIMARY KEY (`id_klausul`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuisioner_klausul`
--

/*!40000 ALTER TABLE `kuisioner_klausul` DISABLE KEYS */;
INSERT INTO `kuisioner_klausul` VALUES (1,'KOMITMEN MANAJEMEN'),(2,'LINGKUNGAN'),(3,'BANGUNAN UPI'),(4,'PENATAAN & PEMELIHARAAN'),(5,'BAHAN BAKU/TAMBAHAN/PENGEMAS'),(6,'PENYIMPANAN PRODUK (SESUAI PERLAKUAN)'),(7,'IPAL'),(8,'AIR & ES'),(9,'PERALATAN & PERLENGKAPAN YANG KONTA DENGAN PRODUK'),(10,'FASILITAS PENCUCIAN'),(11,'KONSTRUKSI & TATA LETAK ALUR PROSES'),(12,'KEBERSIHAN RUANGAN & PERALATAN PENGOLAHAN'),(13,'FASILITAS KARYAWAN'),(14,'BAHAN KIMIA & BAHAN BERBAHAYA'),(15,'LIMBAH PADAT & LIMBAH LAINNYA'),(16,'PENGEMASAN & PELABELAN'),(17,'KEBERSIHAN & KESEHATAN KARYAWAN'),(18,'PENINGKATAN KEMAMPUAN/KETRAMPILAN'),(19,'PENGENDALIAN BINATANG PENGGANGGU');
/*!40000 ALTER TABLE `kuisioner_klausul` ENABLE KEYS */;

--
-- Table structure for table `nilai_tambah`
--

DROP TABLE IF EXISTS `nilai_tambah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nilai_tambah` (
  `id_ntb` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `id_upi` int(11) NOT NULL,
  `harga_bahan_baku` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `randemen_produk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_ntb`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai_tambah`
--

/*!40000 ALTER TABLE `nilai_tambah` DISABLE KEYS */;
/*!40000 ALTER TABLE `nilai_tambah` ENABLE KEYS */;

--
-- Table structure for table `olahan`
--

DROP TABLE IF EXISTS `olahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `olahan` (
  `id_olahan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_olahan` varchar(30) NOT NULL,
  PRIMARY KEY (`id_olahan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `olahan`
--

/*!40000 ALTER TABLE `olahan` DISABLE KEYS */;
INSERT INTO `olahan` VALUES (1,'Lainnya'),(2,'Surimi'),(3,'Beku'),(4,'Kaleng'),(5,'Reduksi'),(6,'Kering'),(7,'Segar'),(8,'Pindang');
/*!40000 ALTER TABLE `olahan` ENABLE KEYS */;

--
-- Table structure for table `pembinaan`
--

DROP TABLE IF EXISTS `pembinaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembinaan` (
  `id_pembinaan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pembinaan` date NOT NULL,
  `sisa_hari` int(11) NOT NULL,
  `id_upi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pimpinan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pembinaan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembinaan`
--

/*!40000 ALTER TABLE `pembinaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembinaan` ENABLE KEYS */;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `id_olahan` int(10) NOT NULL,
  `ket` varchar(20) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES (1,'Abalone Kering',6,''),(2,'Bandeng Presto, Otak-otak Bandeng, Pepes Bandeng, ',1,''),(3,'Belut Hidup',1,''),(4,'Cephalopoda Beku',3,''),(5,'Daging Bekicot Beku',3,''),(6,'Daging Bekicot Kaleng',4,''),(7,'Daging Kerang Beku',3,''),(8,'Daging Rajungan Kaleng Pasteurisasi Beku',4,''),(9,'Daging Rajungan Kaleng Pasteurisasi Dingin',4,''),(10,'Daging Rajungan Pasteurisasi',4,''),(11,'Daging Rajungan Rebus Dingin',1,''),(12,'Fillet Ikan Beku',3,''),(13,'Hidrolisis Kepala dan Tulang Ikan',1,''),(14,'Hidrolisis Kepala Udang',1,''),(15,'Hiu Beku',3,''),(16,'Ikan Air Tawar Beku',3,''),(17,'Ikan Beku Hasil Budidaya',3,''),(18,'Ikan Demersal Beku',3,''),(19,'Ikan Demersal Hidup',1,''),(20,'Ikan Demersal Segar',7,''),(21,'Ikan Hidup',1,''),(22,'Ikan Kaleng (Sarden & Makarel)',4,''),(23,'Ikan Kaleng (Sarden)',4,''),(24,'Ikan Kering',6,''),(25,'Ikan Pelagis Beku',3,''),(26,'Ikan Pelagis Segar',7,''),(27,'Ikan Pindang',8,''),(28,'Ikan Rebus Beku Hasil Budidaya',3,''),(29,'Ikan Scombroid Beku',3,''),(30,'Ikan Segar Hasil Budidaya',7,''),(31,'Ikan Tambak Beku',3,''),(32,'Kepiting Beku',3,''),(33,'Kepiting Hidup',1,''),(34,'Kerang Beku',3,''),(35,'Kerang Hidup',1,''),(36,'Kerang Kering',6,''),(37,'Kerang Segar',7,''),(38,'Kerupuk Ikan',1,''),(39,'Kerupuk Ikan Goreng',1,''),(40,'Kerupuk Ikan, Kerupuk Udang',1,''),(41,'Kerupuk Udang',1,''),(42,'Kerupuk Udang Goreng',1,''),(43,'Kulit Ikan Pari Kering',6,''),(44,'Lobster Hidup',1,''),(45,'Makerel Kaleng',4,''),(46,'Minyak ikan',1,''),(47,'Moluska Beku',3,''),(48,'Pasta Ikan Beku',2,''),(49,'Perut Ikan Kering',6,''),(50,'Produk Bernilai Tambah Beku',3,''),(51,'Produk Cumi Bernilai Tambah Beku',1,''),(52,'Produk Ikan Air Tawar Beku',1,''),(53,'Produk Ikan Bernilai Tambah Beku',1,''),(54,'Produk Kepiting Bernilai Tambah Beku',1,''),(55,'Produk Perikanan Bernilai Tambah',1,''),(56,'Produk Perikanan Bernilai Tambah Beku',3,''),(57,'Produk Perikanan Bernilai Tambah Beku dan Produk V',3,''),(58,'Produk Udang Bernilai Tambah Beku',3,''),(59,'Rumput Laut Kering',6,''),(60,'Salmon Beku',3,''),(61,'Sarden Kaleng',4,''),(62,'Scallop Hidup',1,''),(63,'Scombroid Beku',3,''),(64,'Seafood Beku Bernilai Tambah',3,''),(65,'Sidat Hidup',1,''),(66,'Sirip Hiu Kering',6,''),(67,'Sirip Ikan Hiu Kering',6,''),(68,'Surimi Beku',2,''),(69,'Telur Ikan Beku',3,''),(70,'Telur Ikan Kering',6,''),(71,'Telur Ikan Terbang Beku',3,''),(72,'Telur Ikan Terbang Kering',6,''),(73,'Tepung Agar',5,''),(74,'Tepung Agar - agar',5,''),(75,'Tepung Ikan',5,''),(76,'Teripang Basah',7,''),(77,'Teripang Kering',6,''),(78,'Tulang Ikan Kering, Perut Ikan Kering, Kulit Ikan ',6,''),(79,'Tuna Beku',3,''),(80,'Tuna Kaleng',4,''),(81,'Tuna Kaleng Untuk Pet',4,''),(82,'Tuna Loin Beku',3,''),(83,'Tuna Loin Masak Beku',3,''),(84,'Tuna Masak Beku',3,''),(85,'Tuna Pouch',4,''),(86,'Tuna Rebus Beku',3,''),(87,'Tuna Segar',7,''),(88,'Udang Asin Kering Beku',3,''),(89,'Udang Beku',3,''),(90,'Udang Berlapis Tepung Beku',3,''),(91,'Udang Hidup',1,''),(92,'Udang Kipas Beku',3,''),(93,'Udang Mentah Beku',3,''),(94,'Udang Rebus Beku',3,''),(95,'Udang Segar',7,''),(96,'Udang Tepung Beku',3,'');
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

--
-- Table structure for table `sertifikat`
--

DROP TABLE IF EXISTS `sertifikat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT,
  `no_sertifikat` varchar(50) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `id_upi` int(11) NOT NULL,
  `tgl_kadaluwarsa` date NOT NULL,
  `berlaku` int(11) NOT NULL,
  PRIMARY KEY (`id_sertifikat`),
  KEY `sertifikat_ibfk_1` (`id_detail`),
  KEY `sertifikat_ibfk_2` (`id_upi`),
  CONSTRAINT `sertifikat_ibfk_1` FOREIGN KEY (`id_detail`) REFERENCES `sertifikat_detail` (`id_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sertifikat_ibfk_2` FOREIGN KEY (`id_upi`) REFERENCES `upi` (`id_upi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sertifikat`
--

/*!40000 ALTER TABLE `sertifikat` DISABLE KEYS */;
/*!40000 ALTER TABLE `sertifikat` ENABLE KEYS */;

--
-- Table structure for table `sertifikat_detail`
--

DROP TABLE IF EXISTS `sertifikat_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sertifikat_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sertifikat` varchar(30) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sertifikat_detail`
--

/*!40000 ALTER TABLE `sertifikat_detail` DISABLE KEYS */;
INSERT INTO `sertifikat_detail` VALUES (1,'SNI'),(2,'HALAL'),(3,'P-IRT'),(4,'MD'),(5,'SKP'),(6,'HACCP');
/*!40000 ALTER TABLE `sertifikat_detail` ENABLE KEYS */;

--
-- Table structure for table `skp`
--

DROP TABLE IF EXISTS `skp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skp` (
  `id_skp` int(11) NOT NULL AUTO_INCREMENT,
  `no_skp` varchar(50) NOT NULL,
  `id_upi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jenis_skp` varchar(20) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `berlaku` int(11) NOT NULL,
  PRIMARY KEY (`id_skp`),
  UNIQUE KEY `no_skp` (`no_skp`)
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skp`
--

/*!40000 ALTER TABLE `skp` DISABLE KEYS */;
INSERT INTO `skp` VALUES (32,'7177/35/SKP/KR/IX/2017',69,1,'','2017-09-12','2019-09-12',-81),(33,'7753/35/SKP/LN/XII/2017',105,2,'','2017-12-21','2019-12-21',19),(34,'6042/35/SKP/LN/III/2017',70,3,'','2017-03-06','2019-03-06',-271),(35,'7408/35/SKP/BK/XI/2017',85,4,'','2017-11-01','2019-11-01',-31),(36,'5807/35/SKP/BK/I/2017',3,4,'','2017-01-13','2019-01-13',-323),(37,'6011/35/SKP/BK/II/2017',15,4,'','2017-02-17','2019-02-17',-288),(38,'7038/35/SKP/BK/VIII/2017',65,4,'','2017-08-18','2019-08-18',-106),(39,'7469/35/SKP/BK/XI/2017',16,4,'','2017-11-07','2019-11-07',-25),(40,'6820/35/SKP/BK/VII/2017',55,4,'','2017-07-13','2019-07-13',-142),(41,'6290/35/SKP/BK/IV/2017',17,4,'','2017-04-18','2019-04-18',-228),(42,'6079/35/SKP/BK/III/2017',19,4,'','2017-03-06','2019-03-06',-271),(43,'6209/35/SKP/BK/IV/2017',30,4,'','2017-04-03','2019-04-03',-243),(44,'7324/35/SKP/BK/X/2017',83,4,'','2017-10-20','2019-10-20',-43),(45,'7300/35/SKP/BK/X/2017',76,4,'','2017-10-18','2019-10-18',-45),(46,'7307/35/SKP/BK/X/2017',77,4,'','2017-10-20','2019-10-20',-43),(47,'7495/35/SKP/BK/XI/2017',96,4,'','2017-11-15','2019-11-15',-17),(48,'7758/35/SKP/BK/XII/2017',107,4,'','2017-12-21','2019-12-21',19),(49,'7576/35/SKP/BK/XI/2017',102,4,'','2017-11-28','2019-11-28',-4),(50,'7467/35/SKP/BK/XI/2017',88,4,'','2017-11-07','2019-11-07',-25),(51,'6824/35/SKP/BK/VII/2017',56,4,'','2017-07-13','2019-07-13',-142),(52,'5860/35/SKP/BK/I/2017',10,4,'','2017-01-13','2019-01-13',-323),(53,'7414/35/SKP/BK/XI/2017',87,4,'','2017-11-01','2019-11-01',-31),(54,'5847/35/SKP/BK/I/2017',4,4,'','2017-01-13','2019-01-13',-323),(55,'7767/35/SKP/BK/XII/2017',109,4,'','2017-12-21','2019-12-21',19),(56,'6299/35/SKP/BK/IV/2017',45,4,'','2017-04-18','2019-04-18',-228),(57,'6070/35/SKP/BK/III/2017',37,4,'','2017-03-06','2019-03-06',-271),(58,'7704/35/SKP/BK/XII/2017',103,4,'','2017-12-13','2019-12-13',11),(59,'7498/35/SKP/BK/XI/2017',97,4,'','2017-11-15','2019-11-15',-17),(60,'7235/35/SKP/BK/IX/2017',90,4,'','2017-09-22','2019-09-22',-71),(61,'7190/35/SKP/BK/IX/2017',72,4,'','2017-09-12','2019-09-12',-81),(62,'7183/35/SKP/BK/IX/2017',71,4,'','2017-09-12','2019-09-12',-81),(63,'5955/35/SKP/BK/II/2017',11,4,'','2017-02-07','2019-02-07',-298),(64,'6091/35/SKP/BK/III/2017',23,4,'','2017-03-06','2019-03-06',-271),(65,'6192/35/SKP/BK/III/2017',24,5,'','2017-03-31','2019-03-31',-246),(66,'6193/35/SKP/BK/III/2017',43,5,'','2017-03-31','2019-03-31',-246),(67,'6191/35/SKP/KL/III/2017',24,6,'','2017-03-31','2019-03-31',-246),(68,'5859/35/SKP/BK/I/2017',10,7,'','2017-01-13','2019-01-13',-323),(69,'7762/35/SKP/KL/XII/2017',109,8,'','2017-12-21','2019-12-21',19),(70,'7763/35/SKP/KL/XII/2017',109,9,'','2017-12-21','2019-12-21',19),(71,'6402/35/SKP/KL/V/2017',42,10,'','2017-05-09','2019-05-09',-207),(72,'7752/35/SKP/KL/XII/2017',104,10,'','2017-12-20','2019-12-20',18),(73,'7573/35/SKP/LN/XI/2017',101,11,'','2017-11-28','2019-11-28',-4),(74,'6087/35/SKP/BK/III/2017',23,12,'','2017-03-06','2019-03-06',-271),(75,'6943/35/SKP/LN/VIII/2017',49,13,'','2017-08-15','2019-08-15',-109),(76,'6678/35/SKP/LN/VII/2017',49,14,'','2017-07-04','2019-07-04',-151),(77,'5805/35/SKP/BK/I/2017',3,15,'','2017-01-13','2019-01-13',-323),(78,'7320/35/SKP/BK/X/2017',82,15,'','2017-10-20','2019-10-20',-43),(79,'6295/35/SKP/BK/IV/2017',17,16,'','2017-04-18','2019-04-18',-228),(80,'7309/35/SKP/BK/X/2017',77,16,'','2017-10-20','2019-10-20',-43),(81,'7468/35/SKP/BK/XI/2017',88,16,'','2017-11-07','2019-11-07',-25),(82,'7231/35/SKP/BK/IX/2017',90,16,'','2017-09-22','2019-09-22',-71),(83,'6015/35/SKP/BK/II/2017',16,17,'','2017-02-17','2019-02-17',-288),(84,'6293/35/SKP/BK/IV/2017',17,17,'','2017-04-18','2019-04-18',-228),(85,'6080/35/SKP/BK/III/2017',19,17,'','2017-03-06','2019-03-06',-271),(86,'7326/35/SKP/BK/X/2017',83,17,'','2017-10-20','2019-10-20',-43),(87,'6671/35/SKP/BK/VII/2017',96,17,'','2017-07-04','2019-07-04',-151),(88,'6213/35/SKP/BK/IV/2017',32,17,'','2017-04-07','2019-04-07',-239),(89,'7191/35/SKP/BK/IX/2017',72,17,'','2017-09-12','2019-09-12',-81),(90,'7186/35/SKP/BK/IX/2017',71,17,'','2017-09-12','2019-09-12',-81),(91,'7410/35/SKP/BK/XI/2017',85,18,'','2017-11-01','2019-11-01',-31),(92,'6009/35/SKP/BK/II/2017',15,18,'','2017-02-17','2019-02-17',-288),(93,'6003/35/SKP/BK/II/2017',13,18,'','2017-02-17','2019-02-17',-288),(94,'7036/35/SKP/BK/VIII/2017',65,18,'','2017-08-18','2019-08-18',-106),(95,'6013/35/SKP/BK/II/2017',16,18,'','2017-02-17','2019-02-17',-288),(96,'6005/35/SKP/BK/II/2017',14,18,'','2017-02-17','2019-02-17',-288),(97,'7318/35/SKP/BK/X/2017',81,18,'','2017-10-20','2019-10-20',-43),(98,'6819/35/SKP/BK/VII/2017',55,18,'','2017-07-13','2019-07-13',-142),(99,'6204/35/SKP/BK/IV/2017',29,18,'','2017-04-03','2019-04-03',-243),(100,'6292/35/SKP/BK/IV/2017',17,18,'','2017-04-18','2019-04-18',-228),(101,'6077/35/SKP/BK/III/2017',19,18,'','2017-03-06','2019-03-06',-271),(102,'6206/35/SKP/BK/IV/2017',30,18,'','2017-04-03','2019-04-03',-243),(103,'7321/35/SKP/BK/X/2017',83,18,'','2017-10-20','2019-10-20',-43),(104,'7302/35/SKP/BK/X/2017',76,18,'','2017-10-18','2019-10-18',-45),(105,'6944/35/SKP/BK/VIII/2017',64,18,'','2017-08-15','2019-08-15',-109),(106,'7305/35/SKP/BK/X/2017',77,18,'','2017-10-20','2019-10-20',-43),(107,'7494/35/SKP/BK/XI/2017',96,18,'','2017-11-15','2019-11-15',-17),(108,'6200/35/SKP/BK/IV/2017',27,18,'','2017-04-03','2019-04-03',-243),(109,'6676/35/SKP/BK/VII/2017',47,18,'','2017-07-04','2019-07-04',-151),(110,'7228/35/SKP/BK/IX/2017',73,18,'','2017-09-22','2019-09-22',-71),(111,'7757/35/SKP/BK/XII/2017',107,18,'','2017-12-21','2019-12-21',19),(112,'7466/35/SKP/BK/XI/2017',88,18,'','2017-11-07','2019-11-07',-25),(113,'6823/35/SKP/BK/VII/2017',56,18,'','2017-07-13','2019-07-13',-142),(114,'7481/35/SKP/BK/XI/2017',93,18,'','2017-11-07','2019-11-07',-25),(115,'6395/35/SKP/BK/V/2017',10,18,'','2017-05-09','2019-05-09',-207),(116,'7416/35/SKP/BK/XI/2017',87,18,'','2017-11-01','2019-11-01',-31),(117,'5846/35/SKP/BK/I/2017',4,18,'','2017-01-13','2019-01-13',-323),(118,'7765/35/SKP/BK/XII/2017',109,18,'','2017-12-21','2019-12-21',19),(119,'6300/35/SKP/BK/IV/2017',45,18,'','2017-04-18','2019-04-18',-228),(120,'7755/35/SKP/BK/XII/2017',106,18,'','2017-12-21','2019-12-21',19),(121,'6072/35/SKP/BK/III/2017',37,18,'','2017-03-06','2019-03-06',-271),(122,'7705/35/SKP/BK/XII/2017',103,18,'','2017-12-13','2019-12-13',11),(123,'7497/35/SKP/BK/XI/2017',97,18,'','2017-11-15','2019-11-15',-17),(124,'7233/35/SKP/BK/IX/2017',90,18,'','2017-09-22','2019-09-22',-71),(125,'7188/35/SKP/BK/IX/2017',72,18,'','2017-09-12','2019-09-12',-81),(126,'6198/35/SKP/BK/IV/2017',26,18,'','2017-04-03','2019-04-03',-243),(127,'7181/35/SKP/BK/IX/2017',71,18,'','2017-09-12','2019-09-12',-81),(128,'5953/35/SKP/BK/II/2017',11,18,'','2017-02-07','2019-02-07',-298),(129,'6084/35/SKP/BK/III/2017',21,18,'','2017-03-06','2019-03-06',-271),(130,'6001/35/SKP/BK/II/2017',12,18,'','2017-02-17','2019-02-17',-288),(131,'6089/35/SKP/BK/III/2017',23,18,'','2017-03-06','2019-03-06',-271),(132,'7405/35/SKP/LN/XI/2017',84,19,'','2017-11-01','2019-11-01',-31),(133,'7035/35/SKP/SG/VIII/2017',65,20,'','2017-08-18','2019-08-18',-106),(134,'6038/35/SKP/SG/III/2017',17,20,'','2017-03-06','2019-03-06',-271),(135,'6495/35/SKP/SG/V/2017',44,20,'','2017-05-24','2019-05-24',-192),(136,'7766/35/SKP/SG/XII/2017',109,20,'','2017-12-21','2019-12-21',19),(137,'6075/35/SKP/SG/III/2017',37,20,'','2017-03-06','2019-03-06',-271),(138,'7403/35/SKP/SG/XI/2017',84,20,'','2017-11-01','2019-11-01',-31),(139,'6044/35/SKP/LN/III/2017',70,21,'','2017-03-06','2019-03-06',-271),(140,'6216/35/SKP/KL/IV/2017',33,22,'','2017-04-07','2019-04-07',-239),(141,'6081/35/SKP/KL/III/2017',20,22,'','2017-03-06','2019-03-06',-271),(142,'6297/35/SKP/KL/IV/2017',36,22,'','2017-04-18','2019-04-18',-228),(143,'5857/35/SKP/KL/I/2017',9,22,'','2017-01-13','2019-01-13',-323),(144,'7470/35/SKP/KL/XI/2017',89,22,'','2017-11-07','2019-11-07',-25),(145,'6289/35/SKP/KR/IV/2017',70,24,'','2017-04-18','2019-04-18',-228),(146,'7409/35/SKP/BK/XI/2017',85,25,'','2017-11-01','2019-11-01',-31),(147,'6008/35/SKP/BK/II/2017',15,25,'','2017-02-17','2019-02-17',-288),(148,'7044/35/SKP/BK/VIII/2017',67,25,'','2017-08-18','2019-08-18',-106),(149,'6002/35/SKP/BK/II/2017',13,25,'','2017-02-17','2019-02-17',-288),(150,'7037/35/SKP/BK/VIII/2017',65,25,'','2017-08-18','2019-08-18',-106),(151,'6014/35/SKP/BK/II/2017',16,25,'','2017-02-17','2019-02-17',-288),(152,'6004/35/SKP/BK/II/2017',14,25,'','2017-02-17','2019-02-17',-288),(153,'7317/35/SKP/BK/X/2017',81,25,'','2017-10-20','2019-10-20',-43),(154,'7471/35/SKP/BK/XI/2017',89,25,'','2017-11-07','2019-11-07',-25),(155,'6818/35/SKP/BK/VII/2017',55,25,'','2017-07-13','2019-07-13',-142),(156,'6205/35/SKP/BK/IV/2017',29,25,'','2017-04-03','2019-04-03',-243),(157,'6294/35/SKP/BK/IV/2017',17,25,'','2017-04-18','2019-04-18',-228),(158,'6078/35/SKP/BK/III/2017',19,25,'','2017-03-06','2019-03-06',-271),(159,'6207/35/SKP/BK/IV/2017',30,25,'','2017-04-03','2019-04-03',-243),(160,'7322/35/SKP/BK/X/2017',83,25,'','2017-10-20','2019-10-20',-43),(161,'7301/35/SKP/BK/X/2017',76,25,'','2017-10-18','2019-10-18',-45),(162,'7306/35/SKP/BK/X/2017',77,25,'','2017-10-20','2019-10-20',-43),(163,'7493/35/SKP/BK/XI/2017',96,25,'','2017-11-15','2019-11-15',-17),(164,'6201/35/SKP/BK/IV/2017',27,25,'','2017-04-03','2019-04-03',-243),(165,'7229/35/SKP/BK/IX/2017',73,25,'','2017-09-22','2019-09-22',-71),(166,'7756/35/SKP/BK/XII/2017',107,25,'','2017-12-21','2019-12-21',19),(167,'7577/35/SKP/BK/XI/2017',102,25,'','2017-11-28','2019-11-28',-4),(168,'7465/35/SKP/BK/XI/2017',88,25,'','2017-11-07','2019-11-07',-25),(169,'6822/35/SKP/BK/VII/2017',56,25,'','2017-07-13','2019-07-13',-142),(170,'6827/35/SKP/BK/VII/2017',57,25,'','2017-07-13','2019-07-13',-142),(171,'7482/35/SKP/BK/XI/2017',93,25,'','2017-11-07','2019-11-07',-25),(172,'5858/35/SKP/BK/I/2017',10,25,'','2017-01-13','2019-01-13',-323),(173,'6255/35/SKP/BK/IV/2017',34,25,'','2017-04-07','2019-04-07',-239),(174,'7415/35/SKP/BK/XI/2017',87,25,'','2017-11-01','2019-11-01',-31),(175,'5845/35/SKP/BK/I/2017',4,25,'','2017-01-13','2019-01-13',-323),(176,'7764/35/SKP/BK/XII/2017',109,25,'','2017-12-21','2019-12-21',19),(177,'6669/35/SKP/BK/VII/2017',45,25,'','2017-07-04','2019-07-04',-151),(178,'7754/35/SKP/BK/XII/2017',106,25,'','2017-12-21','2019-12-21',19),(179,'6071/35/SKP/BK/III/2017',37,25,'','2017-03-06','2019-03-06',-271),(180,'7496/35/SKP/BK/XI/2017',97,25,'','2017-11-15','2019-11-15',-17),(181,'7319/35/SKP/BK/X/2017',82,25,'','2017-10-20','2019-10-20',-43),(182,'7232/35/SKP/BK/IX/2017',90,25,'','2017-09-22','2019-09-22',-71),(183,'7189/35/SKP/BK/IX/2017',72,25,'','2017-09-12','2019-09-12',-81),(184,'6199/35/SKP/BK/IV/2017',26,25,'','2017-04-03','2019-04-03',-243),(185,'7162/35/SKP/BK/IX/2017',68,25,'','2017-09-08','2019-09-08',-85),(186,'7182/35/SKP/BK/IX/2017',71,25,'','2017-09-12','2019-09-12',-81),(187,'5954/35/SKP/BK/II/2017',11,25,'','2017-02-07','2019-02-07',-298),(188,'7406/35/SKP/BK/XI/2017',84,25,'','2017-11-01','2019-11-01',-31),(189,'6083/35/SKP/BK/III/2017',21,25,'','2017-03-06','2019-03-06',-271),(190,'6000/35/SKP/BK/II/2017',12,25,'','2017-02-17','2019-02-17',-288),(191,'6088/35/SKP/BK/III/2017',23,25,'','2017-03-06','2019-03-06',-271),(192,'6037/35/SKP/SG/III/2017',17,26,'','2017-03-06','2019-03-06',-271),(193,'6494/35/SKP/SG/V/2017',44,26,'','2017-05-24','2019-05-24',-192),(194,'6074/35/SKP/SG/III/2017',37,26,'','2017-03-06','2019-03-06',-271),(195,'7404/35/SKP/SG/XI/2017',84,26,'','2017-11-01','2019-11-01',-31),(196,'7304/35/SKP/PD/X/2017',76,27,'','2017-10-18','2019-10-18',-45),(197,'6215/35/SKP/BK/IV/2017',32,28,'','2017-04-07','2019-04-07',-239),(198,'6674/35/SKP/BK/VII/2017',47,29,'','2017-07-04','2019-07-04',-151),(199,'7483/35/SKP/BK/XI/2017',93,29,'','2017-11-07','2019-11-07',-25),(200,'5848/35/SKP/BK/I/2017',4,29,'','2017-01-13','2019-01-13',-323),(201,'6214/35/SKP/SG/IV/2017',32,30,'','2017-04-07','2019-04-07',-239),(202,'7303/35/SKP/BK/X/2017',76,31,'','2017-10-18','2019-10-18',-45),(203,'5809/35/SKP/BK/I/2017',3,32,'','2017-01-13','2019-01-13',-323),(204,'6291/35/SKP/BK/IV/2017',17,32,'','2017-04-18','2019-04-18',-228),(205,'7298/35/SKP/BK/X/2017',75,32,'','2017-10-17','2019-10-17',-46),(206,'5957/35/SKP/BK/II/2017',11,32,'','2017-02-07','2019-02-07',-298),(207,'6041/35/SKP/LN/III/2017',70,33,'','2017-03-06','2019-03-06',-271),(208,'6497/35/SKP/LN/V/2017',44,33,'','2017-05-24','2019-05-24',-192),(209,'7399/35/SKP/LN/XI/2017',84,33,'','2017-11-01','2019-11-01',-31),(210,'5808/35/SKP/BK/I/2017',3,34,'','2017-01-13','2019-01-13',-323),(211,'5854/35/SKP/BK/I/2017',7,34,'','2017-01-13','2019-01-13',-323),(212,'6210/35/SKP/BK/IV/2017',30,34,'','2017-04-03','2019-04-03',-243),(213,'6050/35/SKP/BK/III/2017',18,34,'','2017-03-06','2019-03-06',-271),(214,'7325/35/SKP/BK/X/2017',83,34,'','2017-10-20','2019-10-20',-43),(215,'6831/35/SKP/BK/VII/2017',64,34,'','2017-07-13','2019-07-13',-142),(216,'6073/35/SKP/BK/III/2017',37,34,'','2017-03-06','2019-03-06',-271),(217,'7500/35/SKP/BK/XI/2017',97,34,'','2017-11-15','2019-11-15',-17),(218,'6399/35/SKP/BK/V/2017',40,34,'','2017-05-09','2019-05-09',-207),(219,'7236/35/SKP/BK/IX/2017',90,34,'','2017-09-22','2019-09-22',-71),(220,'7407/35/SKP/BK/XI/2017',84,34,'','2017-11-01','2019-11-01',-31),(221,'6043/35/SKP/LN/III/2017',70,35,'','2017-03-06','2019-03-06',-271),(222,'7402/35/SKP/LN/XI/2017',84,35,'','2017-11-01','2019-11-01',-31),(223,'7179/35/SKP/KR/IX/2017',70,36,'','2017-09-12','2019-09-12',-81),(224,'7480/35/SKP/KR/XI/2017',92,36,'','2017-11-07','2019-11-07',-25),(225,'6076/35/SKP/SG/III/2017',37,37,'','2017-03-06','2019-03-06',-271),(226,'6212/35/SKP/LN/IV/2017',39,38,'','2017-04-07','2019-04-07',-239),(227,'6397/35/SKP/LN/V/2017',39,39,'','2017-05-09','2019-05-09',-207),(228,'7314/35/SKP/LN/X/2017',80,40,'','2017-10-20','2019-10-20',-43),(229,'6048/35/SKP/LN/III/2017',39,41,'','2017-03-06','2019-03-06',-271),(230,'7502/35/SKP/LN/XI/2017',99,41,'','2017-11-15','2019-11-15',-17),(231,'6396/35/SKP/LN/V/2017',39,42,'','2017-05-09','2019-05-09',-207),(232,'7042/35/SKP/KR/VIII/2017',66,43,'','2017-08-18','2019-08-18',-106),(233,'6040/35/SKP/LN/III/2017',70,44,'','2017-03-06','2019-03-06',-271),(234,'6496/35/SKP/LN/V/2017',44,44,'','2017-05-24','2019-05-24',-192),(235,'7400/35/SKP/LN/XI/2017',84,44,'','2017-11-01','2019-11-01',-31),(236,'7412/35/SKP/KL/XI/2017',86,45,'','2017-11-01','2019-11-01',-31),(237,'5856/35/SKP/LN/I/2017',8,46,'','2017-01-13','2019-01-13',-323),(238,'6940/35/SKP/BK/VIII/2017',62,47,'','2017-08-15','2019-08-15',-109),(239,'6007/35/SKP/SR/II/2017',15,48,'','2017-02-17','2019-02-17',-288),(240,'7178/35/SKP/KR/IX/2017',70,49,'','2017-09-12','2019-09-12',-81),(241,'7176/35/SKP/KR/IX/2017',69,49,'','2017-09-12','2019-09-12',-81),(242,'7477/35/SKP/KR/XI/2017',92,49,'','2017-11-07','2019-11-07',-25),(243,'7484/35/SKP/BK/XI/2017',94,50,'','2017-11-07','2019-11-07',-25),(244,'7769/35/SKP/LN/XII/2017',109,51,'','2017-12-21','2019-12-21',19),(245,'7760/35/SKP/LN/XII/2017',108,52,'','2017-12-21','2019-12-21',19),(246,'7759/35/SKP/LN/XII/2017',108,53,'','2017-12-21','2019-12-21',19),(247,'7768/35/SKP/LN/XII/2017',109,54,'','2017-12-21','2019-12-21',19),(248,'5803/35/SKP/LN/I/2017',1,55,'','2017-01-13','2019-01-13',-323),(249,'6816/35/SKP/LN/VII/2017',53,56,'','2017-07-13','2019-07-13',-142),(250,'7230/35/SKP/LN/IX/2017',73,56,'','2017-09-22','2019-09-22',-71),(251,'6829/35/SKP/BK/VII/2017',58,56,'','2017-07-13','2019-07-13',-142),(252,'7475/35/SKP/BK/XI/2017',90,57,'','2017-11-07','2019-11-07',-25),(253,'7297/35/SKP/BK/X/2017',75,58,'','2017-10-17','2019-10-17',-46),(254,'6679/35/SKP/KR/VII/2017',73,59,'','2017-07-04','2019-07-04',-151),(255,'6817/35/SKP/KR/VII/2017',54,59,'','2017-07-13','2019-07-13',-142),(256,'6211/35/SKP/KR/IV/2017',31,59,'','2017-04-07','2019-04-07',-239),(257,'6670/35/SKP/KR/VII/2017',46,59,'','2017-07-04','2019-07-04',-151),(258,'6825/35/SKP/BK/VII/2017',57,60,'','2017-07-13','2019-07-13',-142),(259,'5849/35/SKP/KL/I/2017',5,61,'','2017-01-13','2019-01-13',-323),(260,'7413/35/SKP/KL/XI/2017',86,61,'','2017-11-01','2019-11-01',-31),(261,'7572/35/SKP/KL/XI/2017',100,61,'','2017-11-28','2019-11-28',-4),(262,'6498/35/SKP/LN/V/2017',44,62,'','2017-05-24','2019-05-24',-192),(263,'6677/35/SKP/BK/VII/2017',48,63,'','2017-07-04','2019-07-04',-151),(264,'6194/35/SKP/BK/III/2017',43,64,'','2017-03-31','2019-03-31',-246),(265,'5851/35/SKP/BK/I/2017',102,64,'','2017-01-13','2019-01-13',-323),(266,'7703/35/SKP/BK/XII/2017',103,64,'','2017-12-13','2019-12-13',11),(267,'7401/35/SKP/LN/XI/2017',84,65,'','2017-11-01','2019-11-01',-31),(268,'7041/35/SKP/KR/VIII/2017',66,66,'','2017-08-18','2019-08-18',-106),(269,'7479/35/SKP/KR/XI/2017',92,66,'','2017-11-07','2019-11-07',-25),(270,'6045/35/SKP/KR/III/2017',70,67,'','2017-03-06','2019-03-06',-271),(271,'6049/35/SKP/KR/III/2017',69,67,'','2017-03-06','2019-03-06',-271),(272,'5861/35/SKP/KR/I/2017',10,67,'','2017-01-13','2019-01-13',-323),(273,'7227/35/SKP/SR/IX/2017',73,68,'','2017-09-22','2019-09-22',-71),(274,'7312/35/SKP/SR/X/2017',79,68,'','2017-10-20','2019-10-20',-43),(275,'5804/35/SKP/SR/I/2017',2,68,'','2017-01-13','2019-01-13',-323),(276,'6302/35/SKP/SR/IV/2017',45,68,'','2017-04-18','2019-04-18',-228),(277,'7040/35/SKP/BK/VIII/2017',79,69,'','2017-08-18','2019-08-18',-106),(278,'7039/35/SKP/KR/VIII/2017',79,70,'','2017-08-18','2019-08-18',-106),(279,'6398/35/SKP/BK/V/2017',29,71,'','2017-05-09','2019-05-09',-207),(280,'6680/35/SKP/BK/VII/2017',51,71,'','2017-07-04','2019-07-04',-151),(281,'7185/35/SKP/BK/IX/2017',71,71,'','2017-09-12','2019-09-12',-81),(282,'6203/35/SKP/KR/IV/2017',29,72,'','2017-04-03','2019-04-03',-243),(283,'6202/35/SKP/KR/IV/2017',28,72,'','2017-04-03','2019-04-03',-243),(284,'6681/35/SKP/KR/VII/2017',51,72,'','2017-07-04','2019-07-04',-151),(285,'7184/35/SKP/KR/IX/2017',71,72,'','2017-09-12','2019-09-12',-81),(286,'7310/35/SKP/RD/X/2017',78,73,'','2017-10-20','2019-10-20',-43),(287,'7501/35/SKP/RD/XI/2017',98,74,'','2017-11-15','2019-11-15',-17),(288,'7472/35/SKP/RD/XI/2017',89,75,'','2017-11-07','2019-11-07',-25),(289,'6288/35/SKP/RD/IV/2017',35,75,'','2017-04-18','2019-04-18',-228),(290,'5855/35/SKP/RD/I/2017',8,75,'','2017-01-13','2019-01-13',-323),(291,'6301/35/SKP/RD/IV/2017',45,75,'','2017-04-18','2019-04-18',-228),(292,'6298/35/SKP/RD/IV/2017',36,75,'','2017-04-18','2019-04-18',-228),(293,'6047/35/SKP/RD/III/2017',111,75,'','2017-03-06','2019-03-06',-271),(294,'7772/35/SKP/SG/XII/2017',110,76,'','2017-12-21','2019-12-21',19),(295,'6012/35/SKP/KR/II/2017',15,77,'','2017-02-17','2019-02-17',-288),(296,'6046/35/SKP/KR/III/2017',70,77,'','2017-03-06','2019-03-06',-271),(297,'7043/35/SKP/KR/VIII/2017',66,77,'','2017-08-18','2019-08-18',-106),(298,'6942/35/SKP/KR/VIII/2017',63,77,'','2017-08-15','2019-08-15',-109),(299,'7478/35/SKP/KR/XI/2017',92,77,'','2017-11-07','2019-11-07',-25),(300,'7771/35/SKP/KR/XII/2017',110,77,'','2017-12-21','2019-12-21',19),(301,'7770/35/SKP/KR/XII/2017',110,78,'','2017-12-21','2019-12-21',19),(302,'6010/35/SKP/BK/II/2017',15,79,'','2017-02-17','2019-02-17',-288),(303,'6006/35/SKP/BK/II/2017',14,79,'','2017-02-17','2019-02-17',-288),(304,'7315/35/SKP/BK/X/2017',81,79,'','2017-10-20','2019-10-20',-43),(305,'6821/35/SKP/BK/VII/2017',55,79,'','2017-07-13','2019-07-13',-142),(306,'6208/35/SKP/BK/IV/2017',30,79,'','2017-04-03','2019-04-03',-243),(307,'6672/35/SKP/BK/VII/2017',96,79,'','2017-07-04','2019-07-04',-151),(308,'6675/35/SKP/BK/VII/2017',47,79,'','2017-07-04','2019-07-04',-151),(309,'6826/35/SKP/BK/VII/2017',57,79,'','2017-07-13','2019-07-13',-142),(310,'7234/35/SKP/BK/IX/2017',90,79,'','2017-09-22','2019-09-22',-71),(311,'7192/35/SKP/BK/IX/2017',72,79,'','2017-09-12','2019-09-12',-81),(312,'7160/35/SKP/BK/IX/2017',68,79,'','2017-09-08','2019-09-08',-85),(313,'7187/35/SKP/BK/IX/2017',71,79,'','2017-09-12','2019-09-12',-81),(314,'7474/35/SKP/KL/XI/2017',38,80,'','2017-11-07','2019-11-07',-25),(315,'5850/35/SKP/KL/I/2017',5,80,'','2017-01-13','2019-01-13',-323),(316,'7411/35/SKP/KL/XI/2017',86,80,'','2017-11-01','2019-11-01',-31),(317,'7237/35/SKP/KL/IX/2017',74,80,'','2017-09-22','2019-09-22',-71),(318,'7238/35/SKP/KL/IX/2017',38,81,'','2017-09-22','2019-09-22',-71),(319,'6830/35/SKP/BK/VII/2017',64,82,'','2017-07-13','2019-07-13',-142),(320,'7161/35/SKP/BK/IX/2017',68,83,'','2017-09-08','2019-09-08',-85),(321,'6394/35/SKP/BK/V/2017',38,84,'','2017-05-09','2019-05-09',-207),(322,'7473/35/SKP/KL/XI/2017',38,85,'','2017-11-07','2019-11-07',-25),(323,'6412/35/SKP/BK/V/2017',38,86,'','2017-05-09','2019-05-09',-207),(324,'7316/35/SKP/SG/X/2017',81,87,'','2017-10-20','2019-10-20',-43),(325,'6941/35/SKP/BK/VIII/2017',62,88,'','2017-08-15','2019-08-15',-109),(326,'5806/35/SKP/BK/I/2017',3,89,'','2017-01-13','2019-01-13',-323),(327,'7311/35/SKP/BK/X/2017',53,89,'','2017-10-20','2019-10-20',-43),(328,'6296/35/SKP/BK/IV/2017',17,89,'','2017-04-18','2019-04-18',-228),(329,'7323/35/SKP/BK/X/2017',83,89,'','2017-10-20','2019-10-20',-43),(330,'7299/35/SKP/BK/X/2017',76,89,'','2017-10-18','2019-10-18',-45),(331,'7761/35/SKP/LN/XII/2017',108,89,'','2017-12-21','2019-12-21',19),(332,'7308/35/SKP/BK/X/2017',77,89,'','2017-10-20','2019-10-20',-43),(333,'6673/35/SKP/BK/VII/2017',96,89,'','2017-07-04','2019-07-04',-151),(334,'7574/35/SKP/BK/XI/2017',102,89,'','2017-11-28','2019-11-28',-4),(335,'6828/35/SKP/BK/VII/2017',57,89,'','2017-07-13','2019-07-13',-142),(336,'7417/35/SKP/BK/XI/2017',87,89,'','2017-11-01','2019-11-01',-31),(337,'6304/35/SKP/BK/IV/2017',37,89,'','2017-04-18','2019-04-18',-228),(338,'7499/35/SKP/BK/XI/2017',97,89,'','2017-11-15','2019-11-15',-17),(339,'7476/35/SKP/BK/IX/2017',90,89,'','2017-09-22','2019-09-22',-71),(340,'5956/35/SKP/BK/II/2017',11,89,'','2017-02-07','2019-02-07',-298),(341,'6082/35/SKP/BK/III/2017',21,89,'','2017-03-06','2019-03-06',-271),(342,'6090/35/SKP/BK/III/2017',23,89,'','2017-03-06','2019-03-06',-271),(343,'6937/35/SKP/BK/VIII/2017',60,90,'','2017-08-15','2019-08-15',-109),(344,'6814/35/SKP/BK/VII/2017',52,90,'','2017-07-13','2019-07-13',-142),(345,'7180/35/SKP/LN/IX/2017',70,91,'','2017-09-12','2019-09-12',-81),(346,'7045/35/SKP/BK/VIII/2017',67,92,'','2017-08-18','2019-08-18',-106),(347,'6303/35/SKP/BK/IV/2017',45,92,'','2017-04-18','2019-04-18',-228),(348,'6196/35/SKP/BK/III/2017',43,93,'','2017-03-31','2019-03-31',-246),(349,'6413/35/SKP/BK/V/2017',43,93,'','2017-05-09','2019-05-09',-207),(350,'7485/35/SKP/BK/XI/2017',95,93,'','2017-11-07','2019-11-07',-25),(351,'6085/35/SKP/BK/III/2017',22,93,'','2017-03-03','2019-03-03',-274),(352,'7295/35/SKP/BK/X/2017',75,93,'','2017-10-17','2019-10-17',-46),(353,'6939/35/SKP/BK/VIII/2017',62,93,'','2017-08-15','2019-08-15',-109),(354,'6400/35/SKP/BK/V/2017',41,93,'','2017-05-09','2019-05-09',-207),(355,'7701/35/SKP/BK/XII/2017',103,93,'','2017-12-13','2019-12-13',11),(356,'6936/35/SKP/BK/VIII/2017',60,93,'','2017-08-15','2019-08-15',-109),(357,'6935/35/SKP/BK/VIII/2017',59,93,'','2017-08-15','2019-08-15',-109),(358,'6813/35/SKP/BK/VII/2017',52,93,'','2017-07-13','2019-07-13',-142),(359,'6195/35/SKP/BK/III/2017',43,94,'','2017-03-31','2019-03-31',-246),(360,'6414/35/SKP/BK/V/2017',43,94,'','2017-05-09','2019-05-09',-207),(361,'6086/35/SKP/BK/III/2017',22,94,'','2017-03-03','2019-03-03',-274),(362,'7575/35/SKP/BK/XI/2017',102,94,'','2017-11-28','2019-11-28',-4),(363,'5853/35/SKP/BK/I/2017',6,94,'','2017-01-13','2019-01-13',-323),(364,'7296/35/SKP/BK/X/2017',75,94,'','2017-10-17','2019-10-17',-46),(365,'6938/35/SKP/BK/VIII/2017',61,94,'','2017-08-15','2019-08-15',-109),(366,'6401/35/SKP/BK/V/2017',41,94,'','2017-05-09','2019-05-09',-207),(367,'7702/35/SKP/BK/XII/2017',103,94,'','2017-12-13','2019-12-13',11),(368,'6815/35/SKP/BK/VII/2017',52,94,'','2017-07-13','2019-07-13',-142),(369,'6039/35/SKP/SG/III/2017',17,95,'','2017-03-06','2019-03-06',-271),(370,'7313/35/SKP/SG/X/2017',79,95,'','2017-10-20','2019-10-20',-43),(371,'5852/35/SKP/BK/I/2017',102,96,'','2017-01-13','2019-01-13',-323),(372,'6285/35/SKP/LN/IV/2017',35,0,'','2017-04-18','2019-04-18',-228),(373,'6286/35/SKP/LN/IV/2017',35,0,'','2017-04-18','2019-04-18',-228),(374,'6287/35/SKP/LN/IV/2017',35,0,'','2017-04-18','2019-04-18',-228),(375,'6197/35/SKP/RD/III/2017',25,0,'','2017-03-31','2019-03-31',-246);
/*!40000 ALTER TABLE `skp` ENABLE KEYS */;

--
-- Table structure for table `upi`
--

DROP TABLE IF EXISTS `upi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upi` (
  `id_upi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_upi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_upi_jenis` int(11) NOT NULL,
  `skala` varchar(20) NOT NULL,
  `peringkat` varchar(5) NOT NULL,
  `kapasitas_produksi` int(11) NOT NULL,
  `realisasi_produksi` varchar(30) NOT NULL,
  `banyak_coldstorage` int(11) NOT NULL,
  `kapasitas_coldstorage` int(11) NOT NULL,
  `jumlah_pgl` int(11) NOT NULL,
  `jumlah_pgp` int(11) NOT NULL,
  PRIMARY KEY (`id_upi`)
) ENGINE=InnoDB AUTO_INCREMENT=346 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upi`
--

/*!40000 ALTER TABLE `upi` DISABLE KEYS */;
INSERT INTO `upi` VALUES (1,'UD. BINA MAKMUR','RT. 01, RW. II Lingkungan Teleng, Kel. Sidoarjo, Kec. Pacitan, Kab. Pacitan','-','',0,'','',0,'',0,0,0,0),(2,'PT. NASIONAL INDO MINA','Desa Boncong KM. 45 Kecamatan Bancar, Kabupaten Tuban','-','',0,'','',0,'',0,0,0,0),(3,'CV. ANEKA HOSSE','Jl. Kidemang Singomenggolo Kav.4 Ds. Sidomulyo Kec. Buduran, Kab. Sidoarjo','(031) 7510527','',0,'','',0,'',0,0,0,0),(4,'PT. PERIKANAN NUSANTARA (PERSERO) CABANG SURABAYA','Komplek Industri Pergudangan Safe n\'lock, Q - 3009 Jl. Lingkar Timur Km. 5,5 Desa Rangkah Kidul, Kecamatan Sidoarjo, Kabupaten Sidoarjo','-','',0,'','',0,'',0,0,0,0),(5,'PT. AVILA PRIMA INTRA MAKMUR','Jl. Paludem 42 Muncar, Banyuwangi','T: (0333) 593476; F: 593358','',0,'','',0,'',0,0,0,0),(6,'PT. MADSUMAYA INDO SEAFOOD','Kawasan Industri Gresik Kav. C8 - 15, Gresik','T: (031) 3982172; F: 3982372','',0,'','',0,'',0,0,0,0),(7,'CV. SEMBADA','Ds. Sobontoro RT. 002 RW. 003 Sobontoro, Tambakboyo, Tuban','-','',0,'','',0,'',0,0,0,0),(8,'PT. FKS MULTI AGRO Tbk','Jl. Kalimati No.36, Ds. Kedungrejo, Kec. Muncar, Banyuwangi','-','',0,'','',0,'',0,0,0,0),(9,'PT. KOKI INDOCAN','Jl. Pahlawan Tawi No. 1 Ds. Karang Jati, Pandaan, Pasuruan','-','',0,'','',0,'',0,0,0,0),(10,'PT. MARINECIPTA AGUNG','Jl. Wonokoyo, Beji, Pasuruan','T: (0343) 656027; F: 656226','',0,'','',0,'',0,0,0,0),(11,'UD. JAWA MADURA','Pergudangan Safe n\' Lock Blok 0-1737 Lingkar Timur Desa Rangkah Kidul, Kecamatan Sidoarjo, Kabupaten Sidoarjo','-','',0,'','',0,'',0,0,0,0),(12,'UD. PIALA INDAH','Jl. Yos Sudarso Dusun Muncar RT. 01 RW. 03 Desa Kedungrejo, Kec. Muncar, Kab. Banyuwangi','-','',0,'','',0,'',0,0,0,0),(13,'CV. BERLIAN MINATAMA','Jl. Imam Bonjol No. 11 Dusun Stopas, Desa Kedung Rejo, Kecamatan Muncar, Kabupaten Banyuwangi','-','',0,'','',0,'',0,0,0,0),(14,'CV. GIGA SAMUDRA NUSANTARA','Dusun Stopas RT. 001, RW. 002, Desa Kedungrejo, Kecamatan Muncar, Kabupaten Banyuwangi','-','',0,'','',0,'',0,0,0,0),(15,'CV. ANGIN TIMUR SEAFOOD','Pergudangan Sinar Gedangan Blok E-15, Gedangan, Sidoarjo','t: 031-8012816\nf: 031-5911843','',0,'','',0,'',0,0,0,0),(16,'CV. DUTA LAUTAN BUANA','Jl, Raya Lingkar Timur Pergudangan Safe & Lock Blok D 2392, Kel. Rangkah Kidul, Kec. Sidoarjo, Sidoarjo','T: (031) 8067214; F: 8067111','',0,'','',0,'',0,0,0,0),(17,'CV. MARINA SEJAHTERA','Komplek Pergudangan dan Industri Ritz Gate Blok BB-25, Desa Bohar, Kecamatan Gedangan, Kabupaten Sidoarjo','-','',0,'','',0,'',0,0,0,0),(18,'PT. BAHARI BIRU NUSANTARA','Jl. Daendels Km.82.6 No.88. Ds. Sedayulawas, Kec. Brondong, Lamongan','T: (0322) 661888; F: 662888','',0,'','',0,'',0,0,0,0),(19,'PT. ANEKA SUMBER ALAM JAYA','Jl. Pandaan Bangil Desa Tudan Km.4 Kemiri Sewu, Kec. Pandaan, Pasuruan','T: (0343) 630631; F: 630831','',0,'','',0,'',0,0,0,0),(20,'PT. REX CANNING','Jln. Raya Beji - Bangil Km.4 No.42, Pasuruan','T: (0343) 656470; F: (0343) 656475','',0,'','',0,'',0,0,0,0),(21,'UD. PIALA','Jl. Berbek Industri V/25-A Surabaya','-','',0,'','',0,'',0,0,0,0),(22,'PT. GRAHAMAKMUR CIPTAPRATAMA','Jl.. Industri No. 29-A Buduran, Sidoarjo','-','',0,'','',0,'',0,0,0,0),(23,'UD. RIKI UTAMA MANDIRI','Pergudangan Safe and Lock Blok V2-3328 Lingkar Timur, Sidoarjo','-','',0,'','',0,'',0,0,0,0),(24,'CV. KEONG MAS PERMAI','Jl. Raya Sukowati No.410 Kapas, Bojonegoro','T: (0353) 886328; F: 886338','',0,'','',0,'',0,0,0,0),(25,'PT. INDONUSA ALGAEMAS PRIMA','Jl. Balekambang No.99 Watugede, Singosari, Malang','-','',0,'','',0,'',0,0,0,0),(26,'PT. TRITUNGGAL LINTAS SAMUDRA','Komplek Depo Bangunan Blok F No. 14-15, Jl. A. Yani Sidoarjo','Herman Suisa\n(081231399963)','',0,'','',0,'',0,0,0,0),(27,'PT. FISHINDO LINTAS SAMUDRA','Jl. Margomulyo No. 44 Pergudangan Surimulya Blok NN No. 1, Surabaya','Berce Suisa\n(0816506069)','',0,'','',0,'',0,0,0,0),(28,'CV. LIMANTHO','Jl. Raya Hang Tuah No. 4B, Surabaya','(031) 3292325/3293997\n081330448712','',0,'','',0,'',0,0,0,0),(29,'CV. KASIH KARUNIA','JL. Sukomanunggal No. 2-4, Surabaya','(031) 7345148\n','',0,'','',0,'',0,0,0,0),(30,'PT. ANUGRAH LAUT INDONESIA','Desa Sobontoro RT/RW 04/01 Tambakboyo, Tuban','(031) 8662095','',0,'','',0,'',0,0,0,0),(31,'UD. BINA MAKMUR SEJAHTERA','Jl. Tanjungsari No.44 Blok B-26, Surabaya','T: (031) 7483311; F: 7483322','',0,'','',0,'',0,0,0,0),(32,'PT. IROHA SIDAT INDONESIA','Jl. Gatot Subroto No.46, Kel. Bulusan, Kec. Kalipuro, Banyuwangi','T: (0333) 424324; F: 423367','',0,'','',0,'',0,0,0,0),(33,'CV. PASIFIC HARVEST','Jl. Tratas No. 61 Muncar, Banyuwangi','T: (0333) 593368; F: 591618','',0,'','',0,'',0,0,0,0),(34,'PT. MODERN MITRA SEJATI','Jl. Rungkut Industri III No. 85 Surabaya','-','',0,'','',0,'',0,0,0,0),(35,'PT. CHAMIN JAYA INTERNATIONAL','Jl. Raya Cangkir KM. 21 No.302 G, Driyorejo, Gresik','T:(031) 7508775, F:(031) 7508718','',0,'','',0,'',0,0,0,0),(36,'PT. SARI LAUT JAYA FOOD PRODUCTS','Jl. Sampangan B1/A Muncar, Banyuwangi','T: (0333) 593322; F: 593321','',0,'','',0,'',0,0,0,0),(37,'PT. SARANA INDOGUNA LESTARI','Jl. Lontar No. 216 Kel. Lontar, Kec. Sambikerep, Surabaya','-','',0,'','',0,'',0,0,0,0),(38,'PT. ANEKA TUNA INDONESIA','Jl. Gunung Gangsir Rt.1/Rw.7, Dusun Kelangkung, Kec. Pandaan, Pasuruan','T: (0343) 641563; F: 641564','',0,'','',0,'',0,0,0,0),(39,'PT. SEKAR LAUT','Jl. Jenggolo II/17 Sidoarjo','T: (031) 8921605; F: 8941244','',0,'','',0,'',0,0,0,0),(40,'PT. SINDABAD MARINE PIONEER','Jl. Rembang Industri II No. 38 PIER Pasuruan','-','',0,'','',0,'',0,0,0,0),(41,'PT. SATU TIGA ENAM DELAPAN','Jl. Yos Sudarso 72, Banyuwangi','T: (0333) 427898; F: 427889','',0,'','',0,'',0,0,0,0),(42,'CV. KUDATAMA MAS','Jl. KIG. Raya Selatan Kav. E 2-3, Gresik','-','',0,'','',0,'',0,0,0,0),(43,'PT. BUMI MENARA INTERNUSA UNIT DUA','Jl. Margomulyo IV-1, Tandes, Surabaya','T: (031) 7482575; F: 7491005','',0,'','',0,'',0,0,0,0),(44,'CV. VICLIN','Jl. Mastrip No.22, Kel. Kedurus, Kec. Karang Pilang, Surabaya','T: (031) 7667628','',0,'','',0,'',0,0,0,0),(45,'PT. QL HASIL LAUT','Jl. Sedayu Lawas RT. 01 RW. 07 Sedayu Lawas Brondong Lamongan','T: (0322) 662828; F: 663222','',0,'','',0,'',0,0,0,0),(46,'UD. RAHMAT BAHARI','Komplek Pergudangan Mutiara Tambak Langon D-12, Kec. Asemrowo, Surabaya','T/: (031) 7525155','',0,'','',0,'',0,0,0,0),(47,'PT. HAE DONG JAYA ABADI','Jl. Margomulyo Permai Blok H-5, Kelurahan Tambak Sarioso, Kec. Asemrowo, Surabaya','-','',0,'','',0,'',0,0,0,0),(48,'PT. WINDUBLAMBANGAN SEJATI','Jl. Gatot Subroto Km.5 N0.18, Kel. Bulusan, Kec. Kalipuro, Banyuwangi','T: (0333) 423035; F: 423552','',0,'','',0,'',0,0,0,0),(49,'PT. MATAHARI AQUA PROSPERINDO','Desa Jiken, RT. 05, RW. 03 Kec. Tulangan, Kab. Sidoarjo, Jawa Timur','-','',0,'','',0,'',0,0,0,0),(50,'PT. INDO ALGAE UTAMA','Jl. Balekambang No.99 Watugede, Singosari, Malang','-','',0,'','',0,'',0,0,0,0),(51,'PT. AGROMINA WICAKSANA','Jl. Berbek Industri V/25 B Kawasan Industri Berbek Sidoarjo - Jawa Timur','T: (031) 8476662; F: 8476661','',0,'','',0,'',0,0,0,0),(52,'PT. TRI MITRA MAKMUR','Dusun Laok Bindung, Rt.02/Rw.03, Ds. Landangan, Kec. Kapongan, Kab. Situbondo','T: (0338) 67221','',0,'','',0,'',0,0,0,0),(53,'CV. JALADRI FOOD','Dusun Kedung Aron RT.05/02, Desa Gajah Bendo, Kec. Beji - Pasuruan','0343-658894','',0,'','',0,'',0,0,0,0),(54,'PT. RULA LAUTAN NUSANTARA','Jl. Margomulyo Permai H-18 Kel. Greges, Kec. Asemrowo, Surabaya','T/F: (031) 5358983','',0,'','',0,'',0,0,0,0),(55,'CV. INDOJAYA MAKMURABADI','Jl. Sawunggaling 177-183 Taman, Sidoarjo','-','',0,'','',0,'',0,0,0,0),(56,'PT. KARYA MINA PUTRA','Jl. Lingkar Timur KM. 5,5 Kawasan Industri Safe n Lock Blok O 1768-1769 Sidoarjo','-','',0,'','',0,'',0,0,0,0),(57,'PT. KIAT ANANDA COLDSTORAGE','Jl. Raya By Pass Krian Km. 26 No. 10, Desa Bareng- Krajan, Kec. Krian, Kab. Sidoarjo','-','',0,'','',0,'',0,0,0,0),(58,'UD. FAMILY FOOD','Ds. Tenaru Rt.11/Rw.04, Kec. Driyorejo, Gresik','-','',0,'','',0,'',0,0,0,0),(59,'PT. SURYA ALAM TUNGGAL PLANT B','Jl. Raya Tropodo No. 126 B Sidoarjo, Jawa Timur','-','',0,'','',0,'',0,0,0,0),(60,'PT. SEKAR KATOKICHI','Jl. Jenggolo 2 / 17 Gedung A, Sidoarjo','T: (031) 8963611','',0,'','',0,'',0,0,0,0),(61,'PT. PABRIK LAMONGAN BMI','Jl. Raya Lamongan - Gresik Km. 40, Dusun Gajah, Desa Rejosari, Deket, Kabupaten Lamongan','-','',0,'','',0,'',0,0,0,0),(62,'PT. ENAM DELAPAN SEMBILAN','Jl. Deandles KM. 63 Desa Kemantren, Kec. Paciran, Kab. Lamongan','0','',0,'','',0,'',0,0,0,0),(63,'PT. PINGAN SEAFOOD PRODUCT MANUFACTURE','Jl. Margomulyo 44 Komplek Industri Pergudangan Suri Mulia Permai Blok M No.7 Kel. Tambak Sarioso, Kec. Asemrowo, Surabaya','-','',0,'','',0,'',0,0,0,0),(64,'PT. DIMAS REIZA PERWIRA','Jl. Rungkut Industri III/34, Surabaya','T: (031) 8437095; F: 8437169','',0,'','',0,'',0,0,0,0),(65,'CV. BUANA ARTO MORO','Jl. Rembang Industri VII/2 PIER, Pasuruan','T: (0343) 740223; F: 740222','',0,'','',0,'',0,0,0,0),(66,'CV. KIRANA HIKARI INDONESIA','Desa Pranti, Kecamatan Menganti, Kabupaten Gresik','-','',0,'','',0,'',0,0,0,0),(67,'CV. BEE JAY SEAFOODS','Jl. Tanjung Tembaga Barat, Kel. Mayangan, Kec. Mayangan, Probolinggo','T: (0335) 425749; F: 420114','',0,'','',0,'',0,0,0,0),(68,'PT. TUNA INDONESIA MANDIRI','Jl. Raya Yos Sudarso No. 11 Klatak, Kec. Kalipuro, Banyuwangi','T: (0333) 427492','',0,'','',0,'',0,0,0,0),(69,'PT. HOI HING INVESTMENT','Jl. Raya Pakal No. 71 Surabaya','-','',0,'','',0,'',0,0,0,0),(70,'CV. BAHARI MAKMUR','Komplek Pergudangan Meiko Abadi I Blok A-1 C, Desa Wedi, Kecamatan Gedangan, Kabupaten Sidoarjo','-','',0,'','',0,'',0,0,0,0),(71,'PT. VARIA NIAGA NUSANTARA','Dusun Dermo, Desa Gunung Gangsir No. 88, Gunung Gangsir, Beji, Pasuruan','T: (0343) 655243; F: 655244','',0,'','',0,'',0,0,0,0),(72,'PT. SUNRISE NIAGA FISHERY','Dusun Dermo, DS. Gunung Gangsir No. 89 Beji, Pasuruan','-','',0,'','',0,'',0,0,0,0),(73,'PT. INDO LAUTAN MAKMUR','Jl. Raya Sawocangkring No.02, Wonoayu, Sidoarjo','081529173574','',0,'','',0,'',0,0,0,0),(74,'PT. MUNCHAR','Jl. Sampangan Rt.002 Rw.007, Ds. Kedungrejo, Kec. Muncar, Banyuwangi','T: (0333) 593018; F: 593019','',0,'','',0,'',0,0,0,0),(75,'PT. MEGA MARINE PRIDE','Jl. Ds. Wonokoyo, Kec. Beji, Pasuruan','T: (0343) 656513, 656446','',0,'','',0,'',0,0,0,0),(76,'PT. BERKAT AGUNG INDONESIA','Jl. Raya Tuban - Gresik Km. 95, Desa Leran Kulon, Kec. Palang, Kab. Tuban','T : 0356 329396','',0,'','',0,'',0,0,0,0),(77,'PT. DUA IKAN MAKMUR JAYA','Safe n Lock V1/3217 Jl. Lingkar Timur, Desa Rangkah Kidul, Kec. Sidoarjo, Kab. Sidoarjo','-','',0,'','',0,'',0,0,0,0),(78,'PT. SATELIT SRITI','Jl. Raya Surabaya - Pandaan Km.43, Ds. Kepulungan, Kec. Gempol, Pasuruan','T: (0343) 631812; F: 631811','',0,'','',0,'',0,0,0,0),(79,'PT. KELOLA MINA LAUT','Jl. Raya Tuban - Semarang, Km. 30, Desa Sobontoro, Kecamatan Tambakboyo, Kabupaten Tuban','087753000407, 035-6411051','',0,'','',0,'',0,0,0,0),(80,'PT. LEGONG BALI NUSANTARA','Jl. Raya Surabaya - Pandaan Km.40 Gempol - Pasuruan','-','',0,'','',0,'',0,0,0,0),(81,'CV. GIOVANNI SUKSES MAKMUR','Jl. Berbek Industri V No. 1, Sidoarjo','T: 031 8476585','',0,'','',0,'',0,0,0,0),(82,'PT. STARFOOD INTERNATIONAL','Jl. Raya Deandles Km 76 Desa Kandang Semangkon, Kec. Paciran, Lamongan','T: (0322) 666463; F: 666466','',0,'','',0,'',0,0,0,0),(83,'PT. BAHARI SEJAHTERA PERTIWI','Komplek Industri Sinar Buduran III Blok B 45-46 Desa Siwalanpanji, Kec. Buduran, Sidoarjo','-','',0,'','',0,'',0,0,0,0),(84,'UD. MALASINA JAYA WALET','Jl. Raya Buncitan Rt.15/Rw.07 Desa Buncitan, Kec. Sedati, Sidoarjo','T: (031) 8013488; F: 8013500','',0,'','',0,'',0,0,0,0),(85,'CV. ALAM BAYU JAYA','Jl. Pelabuhan No. 09 Dusun Sampangan RT.003 RW. 003 Desa Kedungrejo, Kec. Muncar, Banyuwangi','-','',0,'','',0,'',0,0,0,0),(86,'PT. MAYA MUNCAR','Jl. Sampangan No.22 Kedungrejo, Muncar - Banyuwangi','T: (0333) 593463; F: 593305','',0,'','',0,'',0,0,0,0),(87,'PT. NATIONAL FOOD PACKERS','Jl. Bawean No. 07, Kel. Klatak, Kec. Kalipuro, Banyuwangi','T: (0333) 421726; F: 421780','',0,'','',0,'',0,0,0,0),(88,'PT. JALA LAUTAN MULIA','Pergudangan Safe N Lock Industry and Warehouse Block E-1521, Jl. Lingkar Timur, Desa Rangkah Kidul, Sidoarjo','T: (031) 8073699; F: 8073698','',0,'','',0,'',0,0,0,0),(89,'CV. INDO JAYA PRATAMA','Dusun Stoplas RT.05, RW.04 Kedungrejo, Muncar, Banyuwangi','T: (0333) 593478; F: 59164','',0,'','',0,'',0,0,0,0),(90,'PT. LOUISIANA FAR EAST','Jl. Rembang Industri II/36-A, Kawasan Berikat (EPZ) PIER, Rembang, Pasuruan','T: (0343) 740174; F: 740175','',0,'','',0,'',0,0,0,0),(91,'PT. SUMBER KARUNIA LAUT','Meiko Abadi V Blok C-17, Desa Wadungasih, Kec. Buduran, Sidoarjo','T: 031 99010269, 085755111303, 081330639018','',0,'','',0,'',0,0,0,0),(92,'UD. MEGA MANDIRI','Jl. Kedung Cowek 162-A, Surabaya','-','',0,'','',0,'',0,0,0,0),(93,'PT. LAUTAN BERLIAN INDAH','Jl. Pelabuhan Perikanan Pantai No.1 Probolinggo','-','',0,'','',0,'',0,0,0,0),(94,'PT. KELOLA MINA LAUT - PLANT II','','T : 031 99010269','',0,'','',0,'',0,0,0,0),(95,'PT. BUMI PANGAN SEJAHTERA','Jl. Jenggolo II/17 Gedung B, Sidoarjo','0','',0,'','',0,'',0,0,0,0),(96,'PT. EDMAR MANDIRI JAYA','Pergudangan Safe & Lock Blok V.3128-3129, Lingkar Timur, Sidoarjo','Edith: 081332338667','',0,'','',0,'',0,0,0,0),(97,'PT. SINAR SURYA ALAM','Jl. Raya Tuban Tambakboyo, Desa Sobontoro, Kecamatan Tambakboyo, Kabupaten Tuban','-','',0,'','',0,'',0,0,0,0),(98,'PT. HAKIKI DONARTA','Desa Kemiri Sewu, Kec. Pandaan, Kab. Pasuruan','-','',0,'','',0,'',0,0,0,0),(99,'PT. TITANI ALAM SEMESTA','Ds. Tenaru, Kec. Driyorejo, Gresik','T: (031) 8433615; F: 8433761','',0,'','',0,'',0,0,0,0),(100,'PT. PERFECT INTERNATIONAL FOOD','Jl. Raya Gentik Rt.005/Rw.002, Ds. Kedungrejo, Muncar, Banyuwangi','T: (0333) 593454; F: 591840','',0,'','',0,'',0,0,0,0),(101,'MINI PLANT TRUNOJOYO (PT. KELOLA MINA LAUT)','Dusun Duko Desa Tanjung Kab. Pamekasan','0','',0,'','',0,'',0,0,0,0),(102,'PT. ISTANA CIPTA SEMBADA','Desa Labanasem, Kec. Kabat, Banyuwangi','T: (0333) 630200; F: 630333','',0,'','',0,'',0,0,0,0),(103,'PT. SEKAR BUMI, Tbk','Jl. Jenggolo II/17 - Sidoarjo','T: (031) 8951910; F: 8951915','',0,'','',0,'',0,0,0,0),(104,'PT. NIRWANA SEGARA','Pergudangan Safe & Lock Warehouse Jl. Lingkar Timur Km. 6, J-1652 Rangkah Kidul, Sidoarjo','t: 031-8946053, f:031-8070903','',0,'','',0,'',0,0,0,0),(105,'UD. ARSHAINDO','Desa Tanggulrejo RT. 013, RW. 003, Kec. Manyar, Kab. Gresik','-','',0,'','',0,'',0,0,0,0),(106,'PT. SAMUDERA NUSANTARA ABADI','Desa Lohgung RT. 16 RW. 04 Kecamatan Brondong, Kabupaten Lamongan','Deno Chanota (081338868581)','',0,'','',0,'',0,0,0,0),(107,'PT. INTI LUHUR FUJA ABADI','Jl. Raya Cangkring Malang Km. 6 Kec. Beji, Pasuruan','T: (0343) 656275; F: 656390','',0,'','',0,'',0,0,0,0),(108,'PT. CENTRALPERTIWI BAHARI','Jl. Rungkut Industri III No. 81, 83 dan 85, Kota Surabaya','(021) 57851788 / 57851808','',0,'','',0,'',0,0,0,0),(109,'PT. PHILLIPS SEAFOODS INDONESIA','Jl. Raya Kemantren Rejo Km.10, Rejoso, Pasuruan','T: (0343) 481566; F: 482543','',0,'','',0,'',0,0,0,0),(110,'UD. SINAR JAYA','Jl. Pelita III Desa Randuboto Kec. Sidayu Gresik','-','',0,'','',0,'',0,0,0,0),(111,'UD. ERA INDO INTERNASIONAL','Pergudangan Sinar Gedangan Blok E-25, Jl. Wedi - Betro, Gedangan, Sidoarjo','','',0,'','',0,'',0,0,0,0);
/*!40000 ALTER TABLE `upi` ENABLE KEYS */;

--
-- Table structure for table `upi_jenis`
--

DROP TABLE IF EXISTS `upi_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upi_jenis` (
  `id_upi_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_upi_jenis` varchar(30) NOT NULL,
  PRIMARY KEY (`id_upi_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upi_jenis`
--

/*!40000 ALTER TABLE `upi_jenis` DISABLE KEYS */;
INSERT INTO `upi_jenis` VALUES (1,'UPI'),(2,'UMKM'),(3,'Gudang Beku/ Importir');
/*!40000 ALTER TABLE `upi_jenis` ENABLE KEYS */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jkl` varchar(15) NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `user_agent` text NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `no_telp` (`no_telp`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'mbah de admin','jl.coba','perempuan','085777888999','belumada@gmail.com','admin','21232f297a57a5a743894a0e4a801fc3','admin','156.67.222.198','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','2019-12-02 21:52:46'),(4,'bokir warkop','jl.ninja','laki-laki','09777622','biokir@ggm.com','bokir','82eab75ae02ec3d32fdfbb77a406d3d9','admin','','','0000-00-00 00:00:00'),(5,'cak lon','yuuyuyuyy','laki-laki','777887','hghg@cak','caklon','5b13c74524df9bf3abb12cd78dd49a58','admin','','','0000-00-00 00:00:00'),(6,'test pembina','ssasasa','perempuan','434432','ajsagg@tdrfgg','test','098f6bcd4621d373cade4e832627b4f6','pembina','','','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

--
-- Dumping routines for database 'u958812969_bmutu'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-04 21:05:52
