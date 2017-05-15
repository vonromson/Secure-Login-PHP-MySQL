--
-- Database: `kvcodes_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `kv_users`
--

CREATE TABLE IF NOT EXISTS `kv_users` (
`id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
