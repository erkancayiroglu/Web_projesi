<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_kitap";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->exec("SET CHARACTER SET utf8");
$conn->query("SET NAMES 'utf8'");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
echo "Bağlantı Hatası: " . $e->getMessage()."<br />";
}
?>