<?php
include_once("db_connect.php");
session_start();

$errors=array();

$loginOrEmail=trim($_POST['loginOrEmail']);
$password=trim($_POST['password']);


htmlentities($loginOrEmail, ENT_QUOTES, 'UTF-8');
htmlentities($password, ENT_QUOTES, 'UTF-8');

if($loginOrEmail==""){
    $errors=array_merge($errors,array('login'=>'Please enter your login or email'));
}
if($password==""){
    $errors=array_merge($errors,array('password'=>'Please enter your password'));
}

$sql="SELECT * FROM USER WHERE login=:ulogin OR email=:umail";
$stmt=$conn->prepare($sql);
$stmt->execute([
    'ulogin'=>$loginOrEmail,
    'umail'=>$loginOrEmail
  ]);
  $pepper='huii';//whatever y want
  
  $user=$stmt->fetch();
  if(!$user){
    $errors=array_merge($errors,array('login'=>'There is no account with this username or email'));
  }
  elseif(!password_verify($password.$pepper,$user['password'])){
    $errors=array_merge($errors,array('password'=>'Your password is incorrect'));
  }

if(!$errors){
  setcookie(session_name(), session_id(), strtotime("+10 years"));
  
  $_SESSION['login']=$user['login'];
  $_SESSION['email']=$user['email'];
  
  $sql="UPDATE USER SET session_id =:usession_id WHERE login=:ulogin";
  $stmt=$conn->prepare($sql);
  $stmt->execute([
      'usession_id'=>session_id(),
      'ulogin'     =>$_SESSION['login']
  ]);
}

echo json_encode($errors);
