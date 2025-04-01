<?php
require '../mainconfig.php';
$orders = mysqli_query($db, "SELECT * FROM `services`");
while ($order = mysqli_fetch_array($orders)) {
	mysqli_query($db, "TRUNCATE `services`;");
	print("Berhasil Menghapus Layanan: ".$order['service_name']."<br>"); flush();
}
$orderss = mysqli_query($db, "SELECT * FROM `categories`");
while ($order = mysqli_fetch_array($orderss)) {
	mysqli_query($db, "TRUNCATE `categories`;");
	print("Berhasil Menghapus Categori ".$order['name']."<br>"); flush();
}