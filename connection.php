<?php
$DATABASE_URL = parse_url(getenv("DATABASE_URL"));
// create a database connection
$servername = $DATABASE_URL["host"];
$username = $DATABASE_URL["user"];
$password = $DATABASE_URL["pass"];
$dbname = ltrim($DATABASE_URL["path"], "/");
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>