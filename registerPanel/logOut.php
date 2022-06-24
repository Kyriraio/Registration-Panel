<?php
if(isset($_COOKIE[session_name()]))
{
session_start();
session_unset();
session_destroy();

    header("Location: index.php");
    setcookie(session_name(), session_id(), strtotime("-10 years"));
}
?>
