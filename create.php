<?php
include_once('koneksi.php');



$date = addslashes(htmlentities($_POST['createddate']));

$name = addslashes(htmlentities($_POST['name']));



$insert = "INSERT INTO shoping VALUES (NULL,'$name','$date')";



$exeinsert = mysqli_query($kon,$insert);



$response = array();



if($exeinsert)

{

  $response['code'] =1;

  $response['message'] = "Success! Data Inserted";

}else{

  $response['code'] =0;

  $response['message'] = "Failed! Data Not Inserted";

}



echo json_encode($response);

?>