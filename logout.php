<?php session_start();
unset($_SESSION['uid']);
@session_destroy();
echo "<script langugage='javascript'>window.location.href='index.php';</script>"; ?>