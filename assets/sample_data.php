<?php

// insert sample data into the tables
// insert multiple sample data into the category table
$sql = "INSERT INTO category (CategoryID, CategoryDescription)
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
VALUES ('093-403992', 'Computers in Business', 'Alicia Oneill', 3, 1997, '003', 0),
('23472-8729', 'Exploring Peru', 'Stephanie Birch', 4, 2005, '005', 0),
('237-34823', 'Business Strategy', 'Joe Peppard', 2, 2002, '002', 0),
('23u8-923849', 'A guide to nutrition', 'John Thrope', 2, 1997, '001', 0),
('2983-3494', 'Cooking for children', 'Annabelle Sharper', 1, 2003, '007', 0),
('82n8-308', 'Computers For Idiots', 'Susan O`Neil', 5, 1998, '008', 0),
('9823-23984', 'My life in picture', 'Kevin Graham', 8, 2004, '001', 0),
('9823-2403-0', 'DaVinci Code', 'Dan Brown', 1, 2003, '008', 0),
('98234-029384', 'My Ranch in Texas', 'George Bush', 1, 2005, '001', 0),
('9823-98345', 'How to cook Italian food', 'Jamie Oliver', 2, 2005, '007', 0),
('9823-98487', 'Optimising your business', 'Cleo Blair', 1, 2001, '002', 0),
('988745-234', 'Tara Road', 'Maeve Binchy', 4, 2002, '008', 0),
('993-0040-00', 'My life in bits', 'John Smith', 1, 2001, '001', 0),
('9987-0039882', 'Shooting History', 'Jon Snow', 1, 2003, '001', 0)";
if ($conn->query($sql) === TRUE)
{
    echo "Sample data inserted into books table successfully";
}
else
{
    echo "Error inserting sample data into books table: " . $conn->error;
}


$sql = "INSERT INTO users (Username, Password, FirstName, Surname, AddressLine1, AddressLine2,  City, Telephone, Mobile, Email)
VALUES ('alanjmckenna', 't1234s', 'Alan', 'McKenna', '38 Cranley Road', 'Farview', 'Dublin', '9998399', '856625567', 'alanmckenna@TUD.ie'),
('joecrotty', 'kj7899', 'Joseph', 'Crotty', 'Apt 5 Clyde Road', 'Donnybrook', 'Dublin', '8887889', '976654456', 'joecrotty@TUD.ie'),
('tommy100', '123456', 'Tom', 'Behan', '14 Hyde Road', 'Dalkey', 'Dublin', '9983747', '876738782', 'tombehan@TUD.ie')";
if ($conn->query($sql) === TRUE)
{
    echo "Sample data inserted into users table successfully";
}
else
{
    echo "Error inserting sample data into users table: " . $conn->error;
}


$sql = "INSERT INTO reservations (ISBN, Username, ReservationDate)
VALUES ('98234-02984', 'joecrotty', '11-Oct-2010'),('9823-98345', 'tommy100', '11-Oct-2010')";

if ($conn->query($sql) === TRUE)
{
    echo "Sample data inserted into reservations table successfully";
}
else
{
    echo "Error inserting sample data into reservations table: " . $conn->error;
}

