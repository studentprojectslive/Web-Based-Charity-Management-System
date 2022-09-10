<?php
error_reporting(0);
session_start();
session_destroy();
echo "<script>window.location=index.php;</script>";
?>