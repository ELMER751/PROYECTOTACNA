<?php
session_start();
session_unset();
session_destroy();
header("Location: ingresar_sesion.php");
exit();
?>