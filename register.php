<?php 
include "koneksi.php";
 
$response = array();
 
 function cek_nama($username){
  global $kon;
  $query = "SELECT * FROM user WHERE username = '$username'";
  if( $result = mysqli_query($kon, $query) ) return mysqli_num_rows($result);
}

function register_user($username, $password, $email,$phone,$country,$city,$postcode,$name,$addres){
  global $kon;
  $username = $username;
  $pass = $password;
  $email = $email;
  $phone = $phone;
  $country = $country;
  $city = $city;
  $postcode = $postcode;
  $name = $name;
  $addres = $addres;
   
     
  $query = "INSERT INTO `user`(`id`, `username`, `password`, `email`, `phone`, `country`, `city`, `postcode`, `name`, `addres`) VALUES(NULL,'$username', '$pass', '$email', '$phone','$country','$city','$postcode','$name','$addres')";
  
  $user_new = mysqli_query($kon, $query);
  if( $user_new ) {
    $usr = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($kon, $usr);
    $user = mysqli_fetch_assoc($result);
    return $user;
  }else{
      return NULL;
  }
}
 
if (isset($_POST['username']) OR isset($_POST['password']) OR isset($_POST['email'])) {
  
    $username = addslashes(htmlentities($_POST['username']));
    $password = addslashes(htmlentities($_POST['password']));
    $email = addslashes(htmlentities($_POST['email']));
    $phone = addslashes(htmlentities($_POST['phone']));
    $country = addslashes(htmlentities($_POST['country']));
    $city = addslashes(htmlentities($_POST['city']));
    $postcode = addslashes(htmlentities($_POST['postcode']));
    $name = addslashes(htmlentities($_POST['name']));
    $addres = addslashes(htmlentities($_POST['addres']));
    
    if( cek_nama($username) == 0 ){
      $user = register_user($username, $password, $email,$phone,$country,$city,$postcode,$name,$addres);
      if($user){
        $response["error"] = FALSE;
        $response["user"]["username"] = $user["username"];
        echo json_encode($response);
      }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
        echo json_encode($response);
      }
    }else{
      $response["error"] = TRUE;
      $response["error_msg"] = "User telah ada ";
      echo json_encode($response);
    }
}
?>