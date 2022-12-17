<?php

session_start();
session_destroy();
// if (isset($_COOKIE['usernamemsys'])) {
//     $time = time();
//     setcookie("usernamemsys", $time - 3600);
// }
header("Location: login.php");
