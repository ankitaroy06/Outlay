
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- Database: `users`
-- --------------------------------------------------------
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `expense` varchar(255) NOT NULL,
  `paidon` varchar(255) NOT NULL,
  `paidamt` int(255) NOT NULL,
  `paidby` varchar(255) NOT NULL,
  `bill` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `expenses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;
