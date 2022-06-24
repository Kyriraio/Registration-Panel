<?php
 
function autoLogUpdate(){
    session_start();
require_once 'db_connect.php';
$sql="SELECT * FROM USER WHERE session_id=:usession_id";
$stmt=$conn->prepare($sql);
$stmt->execute([
    'usession_id'=>$_COOKIE[session_name()]
  ]);
  $sessParams=$stmt->fetch( );
  if($sessParams)
  {
    session_regenerate_id(TRUE);
    $_SESSION['login']=$sessParams['login'];
    $_SESSION['email']=$sessParams['email'];
  setcookie(session_name(), session_id(), strtotime("+10 years"));
  $sql="UPDATE USER SET session_id =:usession_id WHERE login=:ulogin";
  $stmt=$conn->prepare($sql);
  $stmt->execute([
      'usession_id'=>session_id(),
      'ulogin'     =>$_SESSION['login']
  ]);  
  header('Location: hub.php');
}
}