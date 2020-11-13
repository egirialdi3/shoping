<?php
include_once('koneksi.php');
$id = $_GET['id'];
$query = "SELECT * FROM shoping WHERE id=$id";
$result = mysqli_query($kon,$query);
$array_data = array();
while($baris = mysqli_fetch_assoc($result))
{
  $array_data[]=$baris;
}

echo json_encode($array_data);
?>