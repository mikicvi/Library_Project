<?php

$sql = "CREATE TABLE IF NOT EXISTS category(
    CategoryID VARCHAR(3) NOT NULL PRIMARY KEY,
    CategoryDescription VARCHAR(50) NOT NULL
    )";

    if($conn->queryy($sql) === TRUE)
    {
        echo "Table category created successfully";
    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }
?>