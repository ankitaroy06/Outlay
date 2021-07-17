
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `plandetails`
--

CREATE TABLE `plandetails` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fromdate` varchar(255) NOT NULL,
  `todate` varchar(255) NOT NULL,
  `initialbudget` int(255) NOT NULL,
  `remaining_amount` int(255) NOT NULL,
  `people` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
ALTER TABLE `plandetails`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT for table `plandetails`
--
ALTER TABLE `plandetails`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;