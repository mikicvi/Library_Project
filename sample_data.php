<?php

// insert sample data into the tables
// insert multiple sample data into the category table
$sql = "INSERT INTO category (CategoryID, CategoryName)
VALUES ('001', 'Health'), ('002', 'Business'), ('003', 'Biography'), ('004', 'Technology'), ('005', 'Travel'), ('006', 'Self-Help'), ('007', 'Cookery'), ('008', 'Fiction')";
if ($conn->query($sql) === TRUE)
{
    echo "Sample data inserted into category table successfully";
}
else
{
    echo "Error inserting sample data into category table: " . $conn->error;
}

// insert multiple sample data into the books table
$sql = "INSERT INTO books (ISBN, BookTitle, Author, Edition, Year, CategoryID, Reserverd)
VALUES ('093-403992', 'Computers in Business', 'Alicia Oneill', 3, 1997, '3', False),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0),
,VALUES ('978-1-60309-057-5', 'The Hunger Games', 'Suzanne Collins', 1, 2008, '008', 0)";