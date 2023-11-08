-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2023 at 01:58 PM
-- Server version: 10.6.15-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hworksmy_mbkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosbingexes`
--

CREATE TABLE `dosbingexes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosbingexes`
--

INSERT INTO `dosbingexes` (`id`, `user_id`, `nama`, `email`, `jabatan`, `created_at`, `updated_at`) VALUES
(11, 71, 'namaPembimbing', 'pembimbing@gmail.com', 'CEO', '2023-11-06 02:58:35', '2023-11-06 02:58:35'),
(12, 72, 'pemlap', 'pemlap@gmail.com', 'CEO', '2023-11-06 06:46:30', '2023-11-06 06:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telepon_pegawai` varchar(255) DEFAULT NULL,
  `alamat_jalan` varchar(255) DEFAULT NULL,
  `nidn` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`id`, `nama`, `nip`, `prodi`, `created_at`, `updated_at`, `telepon_pegawai`, `alamat_jalan`, `nidn`, `jenis_kelamin`, `jenjang`, `jabatan`, `jurusan`, `email`) VALUES
(19, 'AFANDI NUR AZIS THOHARI', '199004112019031014', 'Teknik Informatika', '2023-11-06 02:24:23', '2023-11-06 02:24:23', '-', 'Ratu Ratih I/18', '0011049004', 'Laki-laki', 'Diploma III', 'Dosen', 'Teknik Elektro', 'afandi@polines.ac.id'),
(20, 'SAMUEL BETA KUNTARDJO', '196404121996011001', 'Teknik Elektronika', '2023-11-06 02:24:37', '2023-11-06 02:24:37', '-', 'Jl. Banjarsari No.42B', '0012046404', 'Laki-laki', 'Diploma III', 'Dosen', 'Teknik Elektro', 'sambetak2@polines.ac.id'),
(21, 'YUSNAN BADRUZZAMAN', '197503132006041001', 'Teknik Listrik', '2023-11-06 02:24:47', '2023-11-06 02:24:47', '-', 'Bukit Emerald  Jaya C7-10', '0013037506', 'Laki-laki', 'Diploma III', 'Dosen', 'Teknik Elektro', 'yusnan.badruzzaman@gmail.com'),
(22, 'ABU HASAN', '196506071990031001', 'Teknik Telekomunikasi', '2023-11-06 02:25:01', '2023-11-06 02:25:01', '', 'Jl. Dinar Mas Utara  IV/39', '0007066504', 'Laki-laki', 'Sarjana Terapan', 'Dosen', 'Teknik Elektro', 'abu.hasan@polines.ac.id'),
(23, 'KUWAT SANTOSO', '198407192019031008', 'Teknik Informatika', '2023-11-06 02:29:48', '2023-11-06 02:29:48', '-', 'JL. KEBON JAYATI', '0419078404', 'Laki-laki', 'Diploma III', 'Dosen', 'Teknik Elektro', 'kuwatsantoso@polines.ac.id'),
(24, 'HELMY', '197908102006041001', 'Teknik Telekomunikasi', '2023-11-06 02:45:14', '2023-11-06 02:45:14', '62811278186', 'Jl. Turus Asri IV No. 6', '0010087904', 'Laki-laki', 'Diploma III', 'Dosen', 'Teknik Elektro', 'helmy@polines.ac.id'),
(25, 'AMRAN YOBIOKTABERA', '198810142019031007', 'Teknik Informatika', '2023-11-06 02:49:11', '2023-11-06 02:49:11', '0', 'Perum Dolog Pasadena No.106', '0014108804', 'Laki-laki', 'Diploma III', 'Dosen', 'Teknik Elektro', 'amranyobi@polines.ac.id'),
(26, 'THOMAS AGUNG SETYAWAN', '197203292000031001', 'Teknik Telekomunikasi', '2023-11-07 01:38:28', '2023-11-07 01:38:28', '-', 'Jalan. Palebon Raya no 16, Semarang 50199', '0029037202', 'Laki-laki', 'Diploma III', 'Dosen', 'Teknik Elektro', 'thomas@polines.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `kajur` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `nama_jurusan`, `kajur`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'Teknik Elektro', 'YUSNAN BADRUZZAMAN', 63, '2023-11-06 06:35:17', '2023-11-06 06:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `kkns`
--

CREATE TABLE `kkns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendanaan` varchar(255) NOT NULL,
  `jumlah_anggota` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kkn_members`
--

CREATE TABLE `kkn_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kkn_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `mbkm_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `statusex` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `notex` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logbooks`
--

INSERT INTO `logbooks` (`id`, `mahasiswa_id`, `mbkm_id`, `status`, `statusex`, `body`, `tanggal`, `note`, `notex`, `created_at`, `updated_at`) VALUES
(25, 29, 23, 1, 1, 'logbook pertama', '2023-11-26 16:00:00', NULL, NULL, '2023-11-06 02:59:01', '2023-11-06 03:03:52'),
(26, 29, 24, 1, 1, 'input pertama', '2023-11-20 16:00:00', NULL, NULL, '2023-11-06 06:47:03', '2023-11-06 06:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `ipk` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`id`, `nama`, `nim`, `telp`, `created_at`, `updated_at`, `user_id`, `prodi`, `jurusan`, `jenjang`, `alamat`, `jenis_kelamin`, `ipk`, `kelas`) VALUES
(29, 'KHANSA MUTIARA FATIKASARI', '3.33.21.0.11', '6281329407232', '2023-11-06 02:41:50', '2023-11-06 02:41:50', 68, 'Teknik Telekomunikasi', 'Teknik Elektro', 'Diploma III', 'JL. BERINGIN ELOK IV BLOK B.415', 'P', '3.64773', 'TK-2A'),
(30, 'MUHAMAD GALIH DYAS SETYAWAN', '3.33.21.0.13', '62895422299992', '2023-11-07 01:34:37', '2023-11-07 01:34:37', 73, 'Teknik Telekomunikasi', 'Teknik Elektro', 'Diploma III', 'NGESREP TIMUR VI NO 59', 'L', '3.01136', 'TK-2A');

-- --------------------------------------------------------

--
-- Table structure for table `matkul_swaps`
--

CREATE TABLE `matkul_swaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `swap_student_id` varchar(255) NOT NULL,
  `matkul` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mbkms`
--

CREATE TABLE `mbkms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `pers_kaprodi` varchar(255) DEFAULT NULL,
  `pers_kajur` varchar(255) DEFAULT NULL,
  `pers_direktur` varchar(255) DEFAULT NULL,
  `jenis_mbkm` varchar(255) DEFAULT NULL,
  `diterima` varchar(255) DEFAULT NULL,
  `form_mbkm` varchar(255) DEFAULT NULL,
  `sk_direktur` varchar(255) DEFAULT NULL,
  `evaluasi` varchar(255) DEFAULT NULL,
  `form_penilaian_pembimbing` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  `type_program_id` int(11) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `nama_lembaga` varchar(255) DEFAULT NULL,
  `durasi` varchar(255) DEFAULT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `rincian` text DEFAULT NULL,
  `swap_student_id` int(11) DEFAULT NULL,
  `kkn_id` int(11) DEFAULT NULL,
  `dosbing_report` varchar(255) DEFAULT NULL,
  `dosbingex_report` varchar(255) DEFAULT NULL,
  `dosbingex_logbook` varchar(255) DEFAULT NULL,
  `dosbing_logbook` varchar(255) DEFAULT NULL,
  `dosbingex_id` int(11) DEFAULT NULL,
  `nilai_dosbing` float DEFAULT NULL,
  `nilai_pemlap` float DEFAULT NULL,
  `date_pers` date DEFAULT NULL,
  `judul_kegiatan` varchar(255) DEFAULT NULL,
  `portofolio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mbkms`
--

INSERT INTO `mbkms` (`id`, `mahasiswa_id`, `pers_kaprodi`, `pers_kajur`, `pers_direktur`, `jenis_mbkm`, `diterima`, `form_mbkm`, `sk_direktur`, `evaluasi`, `form_penilaian_pembimbing`, `created_at`, `updated_at`, `status`, `tahun`, `dosen_id`, `report`, `type_program_id`, `prodi`, `alasan`, `nama_lembaga`, `durasi`, `tanggal_awal`, `tanggal_akhir`, `rincian`, `swap_student_id`, `kkn_id`, `dosbing_report`, `dosbingex_report`, `dosbingex_logbook`, `dosbing_logbook`, `dosbingex_id`, `nilai_dosbing`, `nilai_pemlap`, `date_pers`, `judul_kegiatan`, `portofolio`) VALUES
(24, 29, 'Y', 'Y', '20', 'in', NULL, NULL, '01/07.11.23/SK/VII/23', NULL, NULL, '2023-11-06 06:39:48', '2023-11-07 01:44:23', 'AKTIF', '2023', 25, 'Report-0223471061123.pdf', 1, 'Teknik Telekomunikasi', 'ini alasan', 'ini lembaga', '6', '2023-11-21', '2024-05-22', 'ini rincian', NULL, NULL, 'Y', 'Y', NULL, NULL, 12, NULL, 93, '2023-11-06', 'ini judul', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2023_10_31_130854_create_prodis_table', 5),
(7, '2023_10_31_130918_create_jurusans_table', 6),
(9, '2023_10_31_084043_create_pics_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `nilais`
--

CREATE TABLE `nilais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mbkm_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `keaktifan` int(11) NOT NULL,
  `ketrampilan` int(11) NOT NULL,
  `komunikasi` int(11) NOT NULL,
  `kognitif` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifs`
--

CREATE TABLE `notifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `mbkm_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifs`
--

INSERT INTO `notifs` (`id`, `user_id`, `mbkm_id`, `body`, `created_at`, `updated_at`) VALUES
(58, 68, 23, 'Pengajuan MBKM sudah disetujui oleh Kaprodi', '2023-11-06 02:47:53', '2023-11-06 02:47:53'),
(59, 68, 23, 'Pengajuan MBKM sudah disetujui oleh Kaprodi', '2023-11-06 02:55:19', '2023-11-06 02:55:19'),
(60, 68, 23, 'Kamu sudah mendapatkan dosen pembimbing', '2023-11-06 02:55:27', '2023-11-06 02:55:27'),
(61, 68, 23, 'Pengajuan MBKM sudah disetujui oleh Kajur', '2023-11-06 02:56:43', '2023-11-06 02:56:43'),
(62, 71, 23, 'KHANSA MUTIARA FATIKASARI telah mengisi logbook', '2023-11-06 02:59:01', '2023-11-06 02:59:01'),
(63, 70, 23, 'KHANSA MUTIARA FATIKASARI telah mengisi logbook', '2023-11-06 02:59:01', '2023-11-06 02:59:01'),
(64, 68, 23, 'Dosen Pembimbing telah menyetujui logbook anda', '2023-11-06 03:00:19', '2023-11-06 03:00:19'),
(65, 68, 23, 'laporan sudah disetujui oleh Dosen Pembimbing', '2023-11-06 03:00:29', '2023-11-06 03:00:29'),
(66, 68, 23, 'Dosen Pembimbing telah menilai MBKM anda', '2023-11-06 03:00:43', '2023-11-06 03:00:43'),
(67, 68, 23, 'Pembimbing Lapangan telah menyetujui logbook anda', '2023-11-06 03:03:52', '2023-11-06 03:03:52'),
(68, 68, 23, 'laporan sudah disetujui oleh Pembimbing Lapangan', '2023-11-06 03:04:00', '2023-11-06 03:04:00'),
(69, 68, 23, 'Pembimbing Lapangan telah menilai MBKM anda', '2023-11-06 03:04:13', '2023-11-06 03:04:13'),
(70, 68, 24, 'Pengajuan MBKM sudah disetujui oleh Kaprodi', '2023-11-06 06:41:52', '2023-11-06 06:41:52'),
(71, 68, 24, 'Kamu sudah mendapatkan dosen pembimbing', '2023-11-06 06:42:09', '2023-11-06 06:42:09'),
(72, 68, 24, 'Pengajuan MBKM sudah disetujui oleh Kajur', '2023-11-06 06:43:18', '2023-11-06 06:43:18'),
(73, 72, 24, 'KHANSA MUTIARA FATIKASARI telah mengisi logbook', '2023-11-06 06:47:03', '2023-11-06 06:47:03'),
(74, 70, 24, 'KHANSA MUTIARA FATIKASARI telah mengisi logbook', '2023-11-06 06:47:03', '2023-11-06 06:47:03'),
(75, 68, 24, 'Dosen Pembimbing telah menyetujui logbook anda', '2023-11-06 06:48:51', '2023-11-06 06:48:51'),
(76, 68, 24, 'laporan sudah disetujui oleh Dosen Pembimbing', '2023-11-06 06:49:04', '2023-11-06 06:49:04'),
(77, 68, 24, 'Dosen Pembimbing telah menilai MBKM anda', '2023-11-06 06:49:19', '2023-11-06 06:49:19'),
(78, 68, 24, 'Pembimbing Lapangan telah menyetujui logbook anda', '2023-11-06 06:50:40', '2023-11-06 06:50:40'),
(79, 68, 24, 'laporan sudah disetujui oleh Pembimbing Lapangan', '2023-11-06 06:50:55', '2023-11-06 06:50:55'),
(80, 68, 24, 'Pembimbing Lapangan telah menilai MBKM anda', '2023-11-06 06:51:16', '2023-11-06 06:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pics`
--

CREATE TABLE `pics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `jenis_pic` varchar(255) NOT NULL,
  `type_program_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pics`
--

INSERT INTO `pics` (`id`, `user_id`, `dosen_id`, `jenis_pic`, `type_program_id`, `created_at`, `updated_at`) VALUES
(6, 65, 23, 'Riset', 1, '2023-11-06 06:36:04', '2023-11-06 06:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `kaprodi` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `nama_prodi`, `jurusan_id`, `kaprodi`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 'D3 Teknik Telekomunikasi', 11, 'ABU HASAN', 64, '2023-11-06 06:35:39', '2023-11-06 06:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mbkm_id` int(11) NOT NULL,
  `trans_nilai` varchar(255) DEFAULT NULL,
  `pakta_integritas` varchar(255) DEFAULT NULL,
  `rekom_pt_asal` varchar(255) DEFAULT NULL,
  `pers_ortu` varchar(255) DEFAULT NULL,
  `ket_sehat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `mbkm_id`, `trans_nilai`, `pakta_integritas`, `rekom_pt_asal`, `pers_ortu`, `ket_sehat`, `created_at`, `updated_at`) VALUES
(23, 23, 'Nilai-123421055.pdf', 'Pakta-123421055.pdf', 'Rekom-123421055.pdf', 'Ortu-123421055.pdf', NULL, '2023-11-06 02:42:18', '2023-11-06 02:42:55'),
(24, 24, 'Nilai-123400232.pdf', 'Pakta-123400232.pdf', 'Rekom-123400232.pdf', 'Ortu-123400232.pdf', NULL, '2023-11-06 06:39:48', '2023-11-06 06:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `swap_students`
--

CREATE TABLE `swap_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_swap_id` varchar(255) NOT NULL,
  `nama_prodi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_programs`
--

CREATE TABLE `type_programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_programs`
--

INSERT INTO `type_programs` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Penelitian/Riset', '2023-09-25 07:49:26', '2023-09-25 07:49:26'),
(2, 'Proyek Kemanusiaan', '2023-09-25 07:49:26', '2023-09-25 07:49:26'),
(3, 'Kegiatan Wirausaha (UMKM)', '2023-09-25 07:49:26', '2023-09-25 07:49:26'),
(4, 'Studi/Proyek Independen (Bersertifikat Kampus Merdeka)', '2023-09-25 07:49:26', '2023-09-25 07:49:26'),
(5, 'Membangun Desa/Kuliah Kerja Nyata Tematik (KKN Tematik)', '2023-09-25 07:49:26', '2023-09-25 07:49:26'),
(6, 'Magang Praktik Kerja (Magang Sertifikat MBKM)', '2023-09-25 07:49:26', '2023-09-25 07:49:26'),
(7, 'Asistensi Mengajar di Satuan Pendidikan', '2023-09-25 07:49:26', '2023-09-25 07:49:26'),
(8, 'Pertukaran Pelajar', '2023-09-25 07:49:26', '2023-09-25 07:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `type_swaps`
--

CREATE TABLE `type_swaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_swaps`
--

INSERT INTO `type_swaps` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'Antar Prodi di Politeknik Negeri Semarang', '2023-09-25 07:55:12', '2023-09-25 07:55:12'),
(2, 'Antar Prodi pada Perguruan Tinggi yang Berbeda', '2023-09-25 07:55:12', '2023-09-25 07:55:12'),
(3, 'Prodi sama pada Perguruan Tinggi yang berbeda', '2023-09-25 07:55:12', '2023-09-25 07:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `token`) VALUES
(61, 'AFANDI NUR AZIS THOHARI', '199004112019031014', NULL, '$2y$10$TvhYWbMgQdLWe6dP54TsmuBiCpB./dQIaWZ37DB1BuQNEwgTxBw.O', NULL, '2023-11-06 02:24:23', '2023-11-06 02:24:23', 'ADMIN', NULL),
(62, 'SAMUEL BETA KUNTARDJO', '196404121996011001', NULL, '$2y$10$DRZQtmvGgqxPhzlt/l4Wo.IJ6VbQVI2qSOhl4ep8Zfsl5EyHqGprK', NULL, '2023-11-06 02:24:37', '2023-11-06 06:37:29', 'PIMPINAN', NULL),
(63, 'YUSNAN BADRUZZAMAN', '197503132006041001', NULL, '$2y$10$8kKExlkz3tg2nDa133cs2ueeqBTqRCCUg2rVWFfHMQW1cgIXgksn6', NULL, '2023-11-06 02:24:47', '2023-11-06 06:36:57', 'KAJUR', NULL),
(64, 'ABU HASAN', '196506071990031001', NULL, '$2y$10$6fsHgtjxqGCj5OV.5G49L.gI3W66uXnczG3dGmzjn3C7v73CnqqC.', NULL, '2023-11-06 02:25:01', '2023-11-06 06:36:35', 'KAPRODI', NULL),
(65, 'KUWAT SANTOSO', '198407192019031008', NULL, '$2y$10$u/d0SHgeMPFClRyTO3Nd5eG8aPYxKE2WjSlI0DjaO1oVTL14psUJO', NULL, '2023-11-06 02:29:48', '2023-11-06 06:37:15', 'PIC', NULL),
(68, 'KHANSA MUTIARA FATIKASARI', '3.33.21.0.11', '2023-11-06 02:41:50', '$2y$10$UibRR4YeefH3UpjBetgsGetCOvcEEouHH5cLAeCh1shI/Gr.JFceq', NULL, '2023-11-06 02:41:50', '2023-11-06 02:41:50', 'MHS', 'kEOUNQKlSBlKb7jHNvV3KwtJyliH2TMXsXPJ'),
(69, 'HELMY', '197908102006041001', NULL, '$2y$10$c9UeVMAShQQUUouopQ1N0.1b1.ccyJoNDODRkOgSdcaQ5Fu8yE1b.', NULL, '2023-11-06 02:45:14', '2023-11-06 05:39:42', 'DOSEN', NULL),
(70, 'AMRAN YOBIOKTABERA', '198810142019031007', NULL, '$2y$10$huw91crhut1GkA4FYyTJCuGUzRJE72k2YynsCWgMPr4bix5IV0sbG', NULL, '2023-11-06 02:49:11', '2023-11-06 02:49:11', 'DOSEN', NULL),
(71, 'namaPembimbing', 'pembimbing@gmail.com', NULL, '$2y$10$Ysz/bboOPDmDeAFvtSDmweJbTRGOXkZ7IU4z2l8wRpJAm6mBhdZRi', NULL, '2023-11-06 02:58:31', '2023-11-06 02:58:31', 'PEMLAP', NULL),
(72, 'pemlap', 'pemlap@gmail.com', NULL, '$2y$10$7qYh2xUup//unL1rEL4SU.rmfy4seTKuOabYi1IeZFyNd/r9nkLRi', NULL, '2023-11-06 06:46:27', '2023-11-06 06:46:27', 'PEMLAP', NULL),
(73, 'MUHAMAD GALIH DYAS SETYAWAN', '3.33.21.0.13', '2023-11-07 01:34:37', '$2y$10$TrOG1aBZ9wVOtX72/DqZpOjdV19I4/zEe61B2lvtVtqWKsPpfstBG', NULL, '2023-11-07 01:34:37', '2023-11-07 01:34:37', 'MHS', 'gRZA6Pp6HvEwsLBSU9jH0dDCcc1Bf0A5Vsi6'),
(74, 'THOMAS AGUNG SETYAWAN', '197203292000031001', NULL, '$2y$10$mHPaJMctnACl0cQ6BT6TpOhJAcEUl5l.dZ410g8MpPu4U7e6dEWSG', NULL, '2023-11-07 01:38:28', '2023-11-07 01:38:28', 'DOSEN', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosbingexes`
--
ALTER TABLE `dosbingexes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkns`
--
ALTER TABLE `kkns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kkn_members`
--
ALTER TABLE `kkn_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkul_swaps`
--
ALTER TABLE `matkul_swaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mbkms`
--
ALTER TABLE `mbkms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pics`
--
ALTER TABLE `pics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `swap_students`
--
ALTER TABLE `swap_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_programs`
--
ALTER TABLE `type_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_swaps`
--
ALTER TABLE `type_swaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosbingexes`
--
ALTER TABLE `dosbingexes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kkns`
--
ALTER TABLE `kkns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kkn_members`
--
ALTER TABLE `kkn_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `matkul_swaps`
--
ALTER TABLE `matkul_swaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mbkms`
--
ALTER TABLE `mbkms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifs`
--
ALTER TABLE `notifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pics`
--
ALTER TABLE `pics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `swap_students`
--
ALTER TABLE `swap_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_programs`
--
ALTER TABLE `type_programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `type_swaps`
--
ALTER TABLE `type_swaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
