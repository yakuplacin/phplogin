<?php
session_start();
session_destroy();

// To the login page:
header('Location: index.html');
?>

