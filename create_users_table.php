<?php
$sql="CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL UNIQUE,
                password VARCHAR(6) NOT NULL,
                firstName VARCHAR(30) NOT NULL,
                surname VARCHAR(30) NOT NULL,
                addressLine1 VARCHAR(30) NOT NULL,
                addressLine2 VARCHAR(30) NOT NULL,
                city VARCHAR(30) NOT NULL,
                telephone int(10),
                mobile int (10),
                email VARCHAR(50) NOT NULL,
                reg_date TIMESTAMP
            )";
            if ($conn->query($sql) === TRUE) 
            {
                echo "Table users created successfully";
            } 
            else 
            {
                echo "Error creating table: " . $conn->error;
            }
?>