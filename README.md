# BluBoltCodeTest

A contact form with customer name, email address, enquiry text and submission button.

This application uses the PHPMailer email sending library which is already included with the application files however further info can be found here: https://github.com/PHPMailer/PHPMailer

Setting up the database:

Database connection varibles can be found and set as desired from line 9 in index.php:

$servername = "localhost";
$username = "root";
$password = "test";
$dbname = "blubolttest";

Please use the following SQL Query to define the table structure:

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
