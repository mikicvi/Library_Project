<?php
    $servername = "localhost";
    $username = "admin";
    $password = "libadmin";
    $dbname = "mylibdb";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
        die("<div class='error'>Connection failed: " . $conn->connect_error . "</div>");
    }
?>