<?php

session_destroy();

session_start();
$_SESSION = [];
header("Location: ../login.php");

?>