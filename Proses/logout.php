<?php
session_start();
session_unset();
session_destroy();
header("Location: ../Server/index.php"); 
exit;
?>