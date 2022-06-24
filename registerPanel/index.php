<?php
require_once 'signIn.php';
      
if(isset($_COOKIE[session_name()]))
{autoLogUpdate();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
<div class="login-page">
  <div class="form">

    <form class="register-form" id="reg_form" >
      <span class="error" id="loginError"></span>
      <input name="login" type="text" placeholder="name"/>
      <span class="error" id="passwordError"></span>
      <input name="password" type="password" placeholder="password"/>
      <span class="error" id="cpasswordError"></span>
      <input name="cpassword"type="password" placeholder="confirm password"/>
      <span class="error" id="emailError"></span>
      <input name="email" type="text" placeholder="email address"/>
      <button id="createAccount">create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>

    <form class="login-form" id="login_form">
      <span class="error" id="_loginError"></span>
      <input name="loginOrEmail" type="text" placeholder="name"/>
      <span class="error" id="_passwordError"></span>
      <input name="password" type="password" placeholder="password"/>
      <button id="loginAccount">login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  
  </div>
</div>

<script src="scripts/swapForms.js"></script>
<script src="scripts/userReg.js"></script>
<script src="scripts/userLogin.js"></script>

</body>
</html>
