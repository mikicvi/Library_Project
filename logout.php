<?php
// log out the user, destroy the session
session_start();
session_destroy();
header('Location: index.php');
?>