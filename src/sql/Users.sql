/**
 * CanaryPHPTools(tm) : Tools to improve your project code (canaryphp@gmail.com)
 * Copyright (c) Canaryphp Software Foundation, Inc. (canaryphp@gmail.com)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Canaryphp Software Foundation, Inc. (canaryphp@gmail.com)
 * @link      https://github.com/canaryphp/canaryphptools CanaryPHP(tm) Project
 * @since     1.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE {TABLENAME} (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=BANNED,1=RUNNIG,2=PENDING_ACTIVATION,3=DISACTIVED',
  `active` int(11) NOT NULL COMMENT '0=OFFLINE;1=ONLINE;2=BUSY',
  `static_token` varchar(255) NOT NULL,
  `tokens` longtext NOT NULL DEFAULT '\'{ "reset_token":[ "value":"123456789", "create":"18:00", "limit":"3600", ], }\'',
  `log` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE {TABLENAME}
  ADD PRIMARY KEY (`id`);
ALTER TABLE {TABLENAME}
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;
