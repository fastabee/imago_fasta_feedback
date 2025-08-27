-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Agu 2025 pada 14.50
-- Versi server: 10.4.28-MariaDB-log
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imago_fasta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `user_iduser` int(255) NOT NULL,
  `komentar` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_idproduct` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `user_iduser`, `komentar`, `foto`, `created_at`, `updated_at`, `product_idproduct`) VALUES
(1, 1, 'Sabun nya mantap banget lembut di mata', '', '2025-08-27 03:19:40', '2025-08-27 03:19:40', 1),
(9, 1, 'Sabun nya Lembut banget Menyehatkan mat', '', '2025-08-27 03:41:38', '2025-08-27 03:41:38', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `nama_product` varchar(255) NOT NULL,
  `foto_product` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`idproduct`, `nama_product`, `foto_product`, `keterangan`, `created_at`) VALUES
(1, 'Sabun Kecantikan Planet KrodilXYZ', 'blog-img4.jpg', 'Produk Kecantikan terbaru yang terbuat dari bahan pilihan dan berkualitas tinggi.Ditempa dengan waktu 100 tahun sehingga dapat memberikan efek abadi bagi yang menggunakanya.\n\nCara Penggunaan:\n1. Beli Produk Terlebih Dahulu\n2. Letakkan Di Area Gravitas', '2025-08-27'),
(2, 'Mineral Murni Planet KrodilXYZ', 'blog-img5.jpg', 'Produk Kesehatan terbaru yang terbuat dari bahan pilihan dan berkualitas tinggi.Di Bekukan Selama 4 abad untuk memberikan efek yang menyegarkan. Mineral ini dapat menghilangkan efek haus selama 3 menit\r\n\r\nCara Penggunaan:\r\n1. Beli Produk Terlebih Dahulu\r\n', '2025-08-27'),
(3, 'Vaksin Virus Korona ', 'blog-img6.jpg', 'Sebuah hasil dari penelitan berjam jam dari ilmuan asal planet Depok yang berhasil menemukan obat segala penyakit korona. Vaksin ini sangat efektif karena dapat menyembuhkan pasien kurang dari 1 malam.\r\n\r\nCara Penggunaan:\r\n\r\n1. Terjangkit Korona Terlebih ', '2025-08-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reply_komentar`
--

CREATE TABLE `reply_komentar` (
  `idreply` int(11) NOT NULL,
  `komentar_idkomentar` int(255) NOT NULL,
  `komentar` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_iduser` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reply_komentar`
--

INSERT INTO `reply_komentar` (`idreply`, `komentar_idkomentar`, `komentar`, `foto`, `created_at`, `updated_at`, `user_iduser`) VALUES
(3, 9, 'Real kah bang?', '', '2025-08-27 03:51:45', '2025-08-27 03:51:45', 3),
(5, 9, 'real cuyyy', '1756293067_d92c63b8488eac0d4365.png', '2025-08-27 04:11:07', '2025-08-27 04:11:07', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `nama`) VALUES
(1, 'fastabee', 'fastabee@gmail.com', '$2a$12$wABWJPKus4jdBg5uJXwOYe83ItTtIBgZHrni6x4dywGP.JbvS9i.y', 'fastabee'),
(2, 'Tes', 'tes@gmail.com', '$2y$10$t2v61EKlgHZNZrlbctwIeemWCleFU/eS11da26R67XKNiXfqovHgm', 'Tes'),
(3, 'Wijaya', 'Wijaya@gmail.com', '$2y$10$c74frFG.V2OiPgnJJkIsSO4F7R1KVZyVRzZXsUF/HCqATwKVbhqjK', 'Wijaya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`);

--
-- Indeks untuk tabel `reply_komentar`
--
ALTER TABLE `reply_komentar`
  ADD PRIMARY KEY (`idreply`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `reply_komentar`
--
ALTER TABLE `reply_komentar`
  MODIFY `idreply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
