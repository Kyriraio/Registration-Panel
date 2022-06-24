<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Приветствую!</h1>
    <h1> <?php echo $_SESSION['login'] ?> </h1>
    <form action="logout.php" method="post">
    <p><input type="submit" value="bye bye"></p>
</form>
    
</body>
</html>