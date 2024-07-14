<?php
session_start();
session_unset();
session_destroy();
header("Location: ../login//loginAdministrador.php"); // Redirigir al inicio de sesión o a la página que desees
exit();
?>