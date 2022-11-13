<?php

$sql = "CREATE TABLE IF NOT EXISTS reservations (
    ISBN VARCHAR(13) NOT NULL,
    Username VARCHAR(30) NOT NULL,
    ReservationDate timestamp NOT NULL,
    PRIMARY KEY (ISBN, Username),
    CONSTRAINT FK_ISBN FOREIGN KEY (ISBN) REFERENCES books (ISBN),
    CONSTRAINT FK_Username FOREIGN KEY (Username) REFERENCES users (Username)
    )";

    if ($conn->query($sql) === TRUE)
    {
        echo "Table reservations created successfully";
    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }
