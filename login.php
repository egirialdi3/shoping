<?php 
include "koneksi.php";
 
 function cek_data_user($email,$pass){
    global $kon;
  $email = $email;
  $password = $pass;
   
  $query  = "SELECT * FROM user WHERE email = '$email'";
  $result = mysqli_query($kon, $query);
  $data = mysqli_fetch_assoc($result);
 
  $pass = $data['password'];
  if($password == $pass){
    return $data;
  }else{
    return false;
  }
}

if (isset($_POST['email']) OR isset($_POST['password'])) {
     
    $email  = $_POST['email'];
    $pass = $_POST['password'];
      
    $user = cek_data_user($email,$pass);
 
    if($user != false){
        $response["error"] = FALSE;
        $response["user"]["username"] = $user["username"];
        echo json_encode($response);
    }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Login gagal. Password/Email salah";
        echo json_encode($response);
    }
 
}else{
    $response["error"] = TRUE;
    $response["error_msg"] = "Email atau Password tidak boleh kosong !";
    echo json_encode($response);
}
?>