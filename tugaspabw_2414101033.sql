-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Okt 2025 pada 14.50
-- Versi server: 8.0.43
-- Versi PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugaspabw_2414101033`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int UNSIGNED NOT NULL,
  `nama_produk` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `deskripsi`, `tagline`, `gambar`, `created_at`) VALUES
(2, 'Genting Palentong Natural', 'Bahan Baku: Tanah Liat & Pasir\r\nWarna: Natural/Tanpa Glazur\r\nPanjang: 33 cm\r\nLebar: 24 cm\r\nTebal: 1,5 cm\r\nBerat: +/- 2 kg\r\nJarak Reng: 26 Cm\r\nVolume: 20 pcs/m2', 'Best seller', 'produk/produk_68edc9dfa39406.32242717.png', '2025-10-14 03:56:15'),
(3, 'Genteng Morando Glazur Transparan', 'Bahan Baku: Tanah Liat & Pasir\r\nWarna: TRANSPARAN\r\nPanjang: 33 cm\r\nLebar: 24 cm\r\nTebal: 1,5 cm\r\nBerat: +/- 2 kg\r\nJarak Reng: 26 Cm\r\nVolume: 20 pcs/m2', 'Best seller', 'produk/produk_68edca28d5c2f9.03681803.png', '2025-10-14 03:57:28'),
(4, 'Genteng Morando Glazur Brown', 'Bahan Baku: Tanah Liat & Pasir\r\nWarna: BROWN\r\nPanjang: 33 cm\r\nLebar: 24 cm\r\nTebal: 1,5 cm\r\nBerat: +/- 2 kg\r\nJarak Reng: 26 Cm\r\nVolume: 20 pcs/m2', 'Best seller, redy stok', 'produk/produk_68edca62e32296.52944680.webp', '2025-10-14 03:58:26'),
(5, 'Nok 3 Way Glazur Brown', 'Nama Produk: Genteng Nok Y (Nok Atas / Nok Siku)\r\n\r\nBahan Baku: Tanah Liat & Pasir\r\n\r\nWarna: Coklat Tua Mengilap (Glazur)\r\n\r\nPanjang: 33 cm\r\n\r\nLebar: 24 cm\r\n\r\nTebal: 1,5 cm\r\n\r\nBerat: ± 2 kg\r\n\r\nJarak Reng: 26 cm\r\n\r\nVolume: 20 pcs/m²', 'Best seller', 'produk/produk_68edcc7201c487.71984034.png', '2025-10-14 04:07:14'),
(6, 'Genteng Nok Ujung Glazur Brown', 'Bahan Baku: Tanah Liat & Pasir\r\n\r\nWarna: Coklat Tua Mengilap (Glazur)\r\n\r\nPanjang: 27 cm\r\n\r\nLebar: 20 cm\r\n\r\nTebal: 1,5 cm\r\n\r\nBerat: ± 1,8 kg\r\n\r\nJarak Reng: 26 cm\r\n\r\nVolume: 20 pcs/m²', 'Best seller, redy stok', 'produk/produk_68edccdc371dc8.39766842.png', '2025-10-14 04:09:00'),
(7, 'Genteng Nok Lurus Glazur Brown', 'Bahan Baku: Tanah Liat & Pasir\r\n\r\nWarna: Coklat Tua Mengilap (Glazur)\r\n\r\nPanjang: 33 cm\r\n\r\nLebar: 24 cm\r\n\r\nTebal: 1,5 cm\r\n\r\nBerat: ± 2,2 kg\r\n\r\nJarak Reng: 26 cm\r\n\r\nVolume: 20 pcs/m²', 'Best seller, redy stok', 'produk/produk_68edcdfc36f669.08218583.png', '2025-10-14 04:13:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'rama', 'rama', '2025-10-07 10:04:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
