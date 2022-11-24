<?php

$sql = "CREATE TABLE IF NOT EXISTS books (
    ISBN VARCHAR(13) NOT NULL PRIMARY KEY,
    BookTitle VARCHAR(50) NOT NULL,
    Author VarChar(50) NOT NULL,
    Edition INT(2) NOT NULL,
    Year INT(4) NOT NULL,
    CategoryID VARCHAR(3) NOT NULL,
    Reserved BOOLEAN NOT NULL,
    CONSTRAINT FK_CategoryID FOREIGN KEY (CategoryID) 
    REFERENCES category (CategoryID)
    )";

    $conn->query($sql)
?>
    