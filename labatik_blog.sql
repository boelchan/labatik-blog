/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `blog_kategori`;
CREATE TABLE `blog_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_seo` varchar(50) DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `banner_img` varchar(250) DEFAULT NULL,
  `judul_seo` varchar(250) DEFAULT NULL,
  `judul` varchar(250) NOT NULL,
  `blog_kategori_id` int(11) DEFAULT NULL,
  `konten` text NOT NULL,
  `status` enum('draft','publish') DEFAULT 'draft',
  `status_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `blog_kategori_id` (`blog_kategori_id`),
  CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`blog_kategori_id`) REFERENCES `blog_kategori` (`id_kategori`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order` mediumint(8) unsigned NOT NULL,
  `page` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uc_email` (`email`) USING BTREE,
  UNIQUE KEY `uc_activation_selector` (`activation_selector`) USING BTREE,
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`) USING BTREE,
  UNIQUE KEY `uc_remember_selector` (`remember_selector`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `wilayah_id` varchar(30) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`) USING BTREE,
  KEY `fk_users_groups_users1_idx` (`user_id`) USING BTREE,
  KEY `fk_users_groups_groups1_idx` (`group_id`) USING BTREE,
  KEY `users_groups_ibfk_1` (`wilayah_id`) USING BTREE,
  CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`wilayah_id`) REFERENCES `m_wilayah` (`id_wilayah`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `users_groups_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

INSERT INTO `blog_kategori` (`id_kategori`, `kategori_seo`, `kategori`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'batik-tematik', 'Batik Tematik', NULL, NULL, NULL, NULL);
INSERT INTO `blog_kategori` (`id_kategori`, `kategori_seo`, `kategori`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'kerja-sama', 'Kerja Sama', NULL, NULL, NULL, NULL);
INSERT INTO `blog_kategori` (`id_kategori`, `kategori_seo`, `kategori`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 'peduli-sosial', 'Peduli Sosial', NULL, NULL, NULL, NULL);
INSERT INTO `blog_kategori` (`id_kategori`, `kategori_seo`, `kategori`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(4, 'event', 'Event', NULL, NULL, NULL, NULL);

INSERT INTO `blog_post` (`id_post`, `banner_img`, `judul_seo`, `judul`, `blog_kategori_id`, `konten`, `status`, `status_date`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '1', '1', NULL, '<p>Saya akan</p><ol><li> mencoba menjelaskan </li><li>kepada Bung</li><li>, bagaimana si cara</li><li><br></li><li><br></li><li><br></li><li>membuat batik</li><li><br></li><li><br></li><li>fdf</li></ol><p>&nbsp;Nah seperti yang sudah diketahui, pada umumnya batik itu dibagi menjadi empat jenis berdasarkan cara pembuatannya. Yaitu batik tulis, cap, cetak dan print (nanti akan dibahas perbedaannya).\r\n\r\nDisini saya akan menjelaskan tentang cara membuat batik tulis, kenapa? Karena batik tulis adalah batik yang paling rumit pembuatannya sekaligus batik terbaik di dunia! Silahkan disimak ya.\r\n\r\n1. Pengkhetelan – Batik itu dibuat diatas sebuah kain, namanya kain Mori. Kain Mori adalah kain tenun berwarna putih yang biasa digunakan sebagai kain untuk membatik. Kain Mori i</p><p>ni yang bagus dibuat dengan bahan katun, tapi ada juga yang polyester, sutra, dan rayon.\r\n\r\nkain mori\r\n\r\nKain Mori yang menjadi bahan dasar batik.\r\n\r\nNah proses pengkhetelan adalah proses dimana kain Mori ini direbus dengan berbagai macam tumbuhan selama berhari-hari. Hasilnya lalu dikeringkan dan dinamakan kain Primisima. Kain Primisima adalah kain batik dengan kualitas nomor satu. Selain kain ini, ada juga kain Prima kualitasnya sedikit dibawahnya.\r\n\r\n2. Menyorek – Ketika membuat batik, tentunya seorang pembatik harus memikirkan gambar apa yang harus ia lukis diatas kain mori. Setelah sudah dapat ide, lalu sang pembatik akan mulai menggambar motifnya diatas kertas atau langsung diatas kain.\r\n\r\nmenyorek batik\r\n\r\nMenyorek batik dari awal.\r\n\r\nIntinya sih menuangkan inspirasinya kedalam bentuk gambar. Nah kalau gambarnya dikertas dulu biasanya digambar pakai pulpen, tapi kalo langsung dikain biasanya digambar pakai pensil biar bisa dihapus. Gambarnya tidak diarsir atau diisi </p><p>penuh. Biasanya gambar itu hanya dibuat garis tepinya saja. Garis tepi inilah nanti yang akan ditutup lilin dengan cara dicanting.\r\n\r\n3. Nyanting / Nglowong – Banyak yang masih bingung, nyanting tuh gimana sih? Untuk apa? Jadi gini, tadikan dalam proses menyorek, gambarnya udah digambar dikertas, terus diulang lagi dikain mori. Atau ya langsung diatas kain mori tanpa gambar dikertas dulu.\r\n\r\nNah setelah motifnya udah </p><p>digambar diatas kain, malam atau biasa dikenal dengan lilin, dibubuhkan persis pada gambar tadi.\r\n\r\nNyanting Batik\r\n\r\nIni adalah proses mencanting batik.\r\n\r\nGunanya apa dicanting? Ini berhubungan sama proses selanjutnya. Yaitu proses pewarnaan kain.\r\n\r\nKarena kain putih ini akan diberikan warna dasar (misalnya hitam), maka bagian-bagian gambar motif yang tidak ingin diwarnai hitam harus dilapisi. Biar mereka tetap putih saat lilin nya dilepas. Agar bagian yang dilapisi lilin bisa diwarnai dengan warna lain nanti. \r\n\r\nProses nyanting ini berlangsung dua kali pada umumnya. Bagian depan yang pertama, lalu bagian belakang kain juga ikut dicanting. Ini dilakukan agar motif yang sudah digambar pensil pada bagian depan, tidak ikut diwarnai warna dasar pada bagian belakang. Karena bisa tembus.\r\n\r\n4. Nembok – Begitu juga dengan bagian-bagian lain yang tidak digambar dengan pensil, tapi ingin diberi warna lain. Bagian ini harus ditembok dengan malam. Biar bagian tersebut tidak berwarna sama dengan warna dasa</p>', 'publish', '2020-05-05', 1, '2020-01-21 17:48:01', 1, '2020-05-05 21:10:17');
INSERT INTO `blog_post` (`id_post`, `banner_img`, `judul_seo`, `judul`, `blog_kategori_id`, `konten`, `status`, `status_date`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '2', '2', 1, 'Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.\r\n\r\nNam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. Nulla aliquet turpis eget sodales scelerisque. Ut accumsan rhoncus sapien a dignissim. Sed vel ipsum nunc. Aliquam erat volutpat. Donec et dignissim elit. Etiam condimentum, ante sed rutrum auctor, quam arcu consequat massa, at gravida enim velit id nisl.\r\n\r\nNullam non felis odio. Praesent aliquam magna est, nec volutpat quam aliquet non. Cras ut lobortis massa, a fringilla dolor. Quisque ornare est at felis consectetur mollis. Aliquam vitae metus et enim posuere ornare. Praesent sapien erat, pellentesque quis sollicitudin eget, imperdiet bibendum magna. Aenean sit amet odio est.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis est lobortis odio dignissim rutrum. Pellentesque blandit lacinia diam, a tincidunt felis tempus eget.\r\n\r\nDonec egestas metus non vehicula accumsan. Pellentesque sit amet tempor nibh. Mauris in risus lorem. Cras malesuada gravida massa eget viverra. Suspendisse vitae dolor erat. Morbi id rhoncus enim. In hac habitasse platea dictumst. Aenean lorem diam, venenatis nec venenatis id, adipiscing ac massa. Nam vel dui eget justo dictum pretium a rhoncus ipsum. Donec venenatis erat tincidunt nunc suscipit, sit amet bibendum lacus posuere. Sed scelerisque, dolor a pharetra sodales, mi augue consequat sapien, et interdum tellus leo et nunc. Nunc imperdiet eu libero ut imperdiet.\r\n\r\nNunc varius ornare tortor. In dignissim quam eget quam sodales egestas. Nullam imperdiet velit feugiat, egestas risus nec, rhoncus felis. Suspendisse sagittis enim aliquet augue consequat facilisis. Nunc sit amet eleifend tellus. Etiam rhoncus turpis quam. Vestibulum eu lacus mattis, dignissim justo vel, fermentum nulla. Donec pharetra augue eget diam dictum, eu ullamcorper arcu feugiat.\r\n\r\nProin ut ante vitae magna cursus porta. Aenean rutrum faucibus augue eu convallis. Phasellus condimentum elit id cursus sodales. Vivamus nec est consectetur, tincidunt augue at, tempor libero.', 'publish', '2020-01-02', 1, '2020-01-21 17:48:01', NULL, NULL);
INSERT INTO `blog_post` (`id_post`, `banner_img`, `judul_seo`, `judul`, `blog_kategori_id`, `konten`, `status`, `status_date`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', 'cara-membuat-batik', 'cara membuat batik', NULL, 'Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.\r\n\r\nNam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. Nulla aliquet turpis eget sodales scelerisque. Ut accumsan rhoncus sapien a dignissim. Sed vel ipsum nunc. Aliquam erat volutpat. Donec et dignissim elit. Etiam condimentum, ante sed rutrum auctor, quam arcu consequat massa, at gravida enim velit id nisl.\r\n\r\nNullam non felis odio. Praesent aliquam magna est, nec volutpat quam aliquet non. Cras ut lobortis massa, a fringilla dolor. Quisque ornare est at felis consectetur mollis. Aliquam vitae metus et enim posuere ornare. Praesent sapien erat, pellentesque quis sollicitudin eget, imperdiet bibendum magna. Aenean sit amet odio est.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis est lobortis odio dignissim rutrum. Pellentesque blandit lacinia diam, a tincidunt felis tempus eget.\r\n\r\nDonec egestas metus non vehicula accumsan. Pellentesque sit amet tempor nibh. Mauris in risus lorem. Cras malesuada gravida massa eget viverra. Suspendisse vitae dolor erat. Morbi id rhoncus enim. In hac habitasse platea dictumst. Aenean lorem diam, venenatis nec venenatis id, adipiscing ac massa. Nam vel dui eget justo dictum pretium a rhoncus ipsum. Donec venenatis erat tincidunt nunc suscipit, sit amet bibendum lacus posuere. Sed scelerisque, dolor a pharetra sodales, mi augue consequat sapien, et interdum tellus leo et nunc. Nunc imperdiet eu libero ut imperdiet.\r\n\r\nNunc varius ornare tortor. In dignissim quam eget quam sodales egestas. Nullam imperdiet velit feugiat, egestas risus nec, rhoncus felis. Suspendisse sagittis enim aliquet augue consequat facilisis. Nunc sit amet eleifend tellus. Etiam rhoncus turpis quam. Vestibulum eu lacus mattis, dignissim justo vel, fermentum nulla. Donec pharetra augue eget diam dictum, eu ullamcorper arcu feugiat.\r\n\r\nProin ut ante vitae magna cursus porta. Aenean rutrum faucibus augue eu convallis. Phasellus condimentum elit id cursus sodales. Vivamus nec est consectetur, tincidunt augue at, tempor libero.', 'publish', '2020-05-05', 1, '2020-01-21 17:48:01', 1, '2020-05-05 21:08:42');
INSERT INTO `blog_post` (`id_post`, `banner_img`, `judul_seo`, `judul`, `blog_kategori_id`, `konten`, `status`, `status_date`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(4, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '4', '4', NULL, '<p><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/Yx5lyOhxrhc\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe></p><blockquote>batik keren</blockquote><p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.\r\n\r\nNam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. Nulla aliquet turpis eget sodales scelerisque. Ut accumsan rhoncus sapien a dignissim. Sed vel ipsum nunc. </p><p><br></p><p>Aliquam erat volutpat. Donec et dignissim elit. Etiam condimentum, ante sed rutrum auctor, quam arcu consequat massa, at gravida enim velit id nisl.\r\n\r\nNullam non felis odio. Praesent aliquam magna est, nec volutpat quam aliquet non. Cras ut lobortis massa, a fringilla dolor. Quisque ornare est at felis consectetur mollis. Aliquam vitae metus et enim posuere ornare. Praesent sapien erat, pellentesque quis sollicitudin eget, imperdiet bibendum magna. Aenean sit amet odio est.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et </p><p>malesuada fames ac turpis egestas. Mauris quis est lobortis odio dignissim rutrum. Pellentesque blandit lacinia diam, a tincidunt felis tempus eget.\r\n\r\nDonec egestas metus non vehicula accumsan. Pellentesque sit amet tempor nibh. Mauris in risus lorem. Cras malesuada gravida massa eget viverra. Suspendisse vitae dolor erat. Morbi id rhoncus enim. In hac habitasse platea dictumst. Aenean lorem diam, venenatis nec venenatis id, adipiscing ac massa. Nam vel dui eget justo dictum pretium a rhoncus ipsum. Donec venenatis erat tincidunt nunc suscipit, sit amet bibendum lacus posuere. Sed scelerisque, dolor a pharetra sodales, mi augue consequat sapien, et interdum tellus leo et nunc. Nunc imperdiet eu libero ut imperdiet.\r\n\r\nNunc varius ornare tortor. In dignissim quam eget quam sodales egestas. Nullam imperdiet velit feugiat, egestas risus nec, rhoncus felis. Suspendisse sagittis enim aliquet augue consequat facilisis. Nunc sit amet eleifend tellus. Etiam rhoncus turpis quam. Vestibulum eu lacus mattis, dignissim justo vel, fermentum nulla. Donec pharetra augue eget diam dictum, eu ullamcorper arcu feugiat.\r\n\r\nProin ut ante vitae magna cursus porta. Aenean rutrum faucibus augue eu convallis. Phasellus condimentum elit id cursus sodales. Vivamus nec est consectetur, tincidunt augue at, tempor libero.</p>', 'publish', '2020-01-04', 1, '2020-01-21 17:48:01', 1, '2020-01-22 22:04:09'),
(6, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '5', '5', NULL, 'nbsdfnm', 'publish', '2020-01-05', 1, '2020-01-22 11:20:24', NULL, NULL),
(7, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '6', '6', NULL, '<p>fakjbdfj afnksdf anfklsdjfkln</p>', 'publish', '2020-01-06', 1, '2020-01-23 16:27:26', 1, '2020-01-23 16:30:37'),
(8, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '7', '7', NULL, 'nbsdfnm', 'publish', '2020-01-07', 1, '2020-01-22 11:20:24', NULL, NULL),
(9, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '8', '8', NULL, 'nbsdfnm', 'publish', '2020-01-08', 1, '2020-01-22 11:20:24', NULL, NULL),
(10, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '9', '9', NULL, 'nbsdfnm', 'publish', '2020-01-09', 1, '2020-01-22 11:20:24', NULL, NULL),
(11, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '10', '10', NULL, 'nbsdfnm', 'publish', '2020-01-10', 1, '2020-01-22 11:20:24', NULL, NULL),
(12, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '11', '11', NULL, 'nbsdfnm', 'publish', '2020-01-11', 1, '2020-01-22 11:20:24', NULL, NULL),
(16, '89c3c165a22d5d5411041018c9ba3d3cdc5731de.jpg', '12', '12', NULL, 'nbsdfnm', 'publish', '2020-01-12', 1, '2020-01-22 11:20:24', NULL, NULL),
(17, '480fdaad74417a115e22bbee6f61cf97f91ff029.jpg', '12312-13-123-13123', '12312 13 123 13123', NULL, '<p>123123</p>', 'publish', '2020-05-05', 1, '2020-05-05 21:12:11', NULL, NULL);

INSERT INTO `groups` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator', NULL, NULL, NULL, '2020-01-22 08:57:03');
INSERT INTO `groups` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'Operator', '', NULL, NULL, NULL, '2019-11-04 14:31:14');




INSERT INTO `page` (`id`, `order`, `page`, `content`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'about', '<p>Batik Tulis Tematik</p><p>Untuk Anda yang Berkelas</p>', NULL, NULL, 1, '2020-04-16 14:57:32');
INSERT INTO `page` (`id`, `order`, `page`, `content`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 4, 'wa', '6283852850999', NULL, NULL, NULL, '2020-01-28 11:24:29');
INSERT INTO `page` (`id`, `order`, `page`, `content`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 5, 'facebook', 'labatik.id', NULL, NULL, NULL, NULL);
INSERT INTO `page` (`id`, `order`, `page`, `content`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(4, 6, 'instagram', 'labatik.id', NULL, NULL, NULL, NULL),
(5, 7, 'youtube', 'UCdEEd17We_QIFWUvywwU4HA', NULL, NULL, NULL, NULL),
(6, 3, 'telepon', '6283852850999', NULL, NULL, NULL, NULL),
(7, 2, 'alamat', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31680.2699173!2d113.853823!3d-7.00531!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x61d22d608be3e032!2sLabatik!5e0!3m2!1sid!2sid!4v1587014350296!5m2!1sid!2sid\" width=\"100%\" height=\"300\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', NULL, NULL, 1, '2020-04-16 15:11:01');

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, '127.0.0.1', 'administrator', '$argon2i$v=19$m=16384,t=4,p=2$NjNMOEtiUXFrMzNDdFY5Qg$89Sbty87cgfTdbS1sDJ2fGekfKeKfV88OKDmvBMOohQ', 'admin@labatik.id', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1588687263, 1, 'Admin', 'istrator', 'ADMIN', '0', NULL, NULL, 1, '2020-05-05 21:01:04');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, '127.0.0.1', 'Operator', '$2y$10$ZTwIHTSQA/tN07rgpBkYS.2CLA3zAVlgh3WivQhamY1Xyjs0CsKri', 'operator@labatik.id', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1571968978, 1, 'operator', NULL, NULL, NULL, NULL, NULL, 1, '2020-01-22 09:39:22');


INSERT INTO `users_groups` (`id`, `user_id`, `group_id`, `wilayah_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`, `wilayah_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(5, 2, 2, NULL, 1, '2020-01-22 09:39:22', NULL, NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;