<?php
session_start();
session_unset();
session_destroy();
header("Location: /bnb-project/pages/login.php");
exit();
?>