<?php
require_once('koneksi.php');

$id = addslashes(htmlentities($_POST['id']));

$date = addslashes(htmlentities($_POST['createddate']));

$name = addslashes(htmlentities($_POST['name']));

$getdata = mysqli_query($kon,"SELECT * FROM shoping WHERE id='$id'");
$rows = mysqli_num_rows($getdata);

$update = "UPDATE shoping SET name='$name',createddate='$date' WHERE id='$id'";
$exequery = mysqli_query($kon,$update);

$respose = array();

if($rows > 0)
{
  if($exequery)
  {
    $respose['code'] = 1;
    $respose['message'] = "Updated Success";
  }else{
    $respose['code'] = 0;
    $respose['message'] = "Updated Failed";
  }
}else{
  $respose['code'] = 0;
  $respose['message'] = "Updated Failed, Not data selected";
}
echo json_encode($respose);
?>