CREATE TABLE `examples` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `channel` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `network` varchar(50) NOT NULL DEFAULT '',
  `maintainer` varchar(25) NOT NULL DEFAULT '',
  `shown` int(1) NOT NULL DEFAULT '0',
  `remove` int(1) NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `added` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)