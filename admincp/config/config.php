<!-- Kết nối cơ sở dữ liệu -->
<?php
$mysqli = new mysqli("localhost","root","","web_ban_sach");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>