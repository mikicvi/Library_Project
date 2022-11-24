<?php

$sql = "CREATE TABLE IF NOT EXISTS category(
    CategoryID VARCHAR(3) NOT NULL PRIMARY KEY,
    CategoryDescription VARCHAR(50) NOT NULL
    )";

    $conn->query($sql)
?>