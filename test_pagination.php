<?php
session_start();
require_once 'db.php';
$sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE Author LIKE '%a%' OR BookTitle LIKE '%a%'";
                $result = $conn->query($sql);
                $number_of_results = mysqli_num_rows($result);
                $number_of_pages = ceil($number_of_results/5);
                if(!isset($_GET['page']))
                {
                    $page = 1;
                }
                else
                {
                    $page = $_GET['page'];
                }
                $start_from_page = ($page-1)*5;
                $sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE Author LIKE '%a%' or BookTitle LIKE '%a%' LIMIT " . $start_from_page . ' , ' . 5 . ';';
                $result = mysqli_query($conn, $sql);
                //print_results($result);
                // print the results with pagination set above
                

                if($result->num_rows > 0)
            {
                // display all of the book details in a table
                echo "<div class='table'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ISBN</th>";
                echo "<th>Book Title</th>";
                echo "<th>Author</th>";
                echo "<th>Edition</th>";
                echo "<th>Year</th>";
                echo "<th>Category</th>";
                echo "<th>Reserved</th>";
                echo "<th>Reserve?</th>";
                echo "</tr>";
                // output data of each row but limit the number of results to 5
                // if there are more than 5 results then display a link to the next page
                //while($row = $result->fetch_assoc() /*and $i <5*/)
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row['ISBN'] . "</td>";
                    echo "<td>" . $row['BookTitle'] . "</td>";
                    echo "<td>" . $row['Author'] . "</td>";
                    echo "<td>" . $row['Edition'] . "</td>";
                    echo "<td>" . $row['Year'] . "</td>";
                    // display the category description from the category table
                    echo "<td>" . $row['CategoryDescription'] . "</td>";
                    //if the value is 0, display Not Reserved, if the value is 1, display Reserved, the value is retrieved from the database and is boolean, suppress the notice 
                    echo "<td>" . @($row['Reserved'] == 0 ? "Not Reserved" : "Reserved") . "</td>";
                    // add checkbox that user can tick to reserve the book if it is not already reserved
                    echo "<form action='' method='post'>";
                    if($row['Reserved'] == 0)
                    {
                        echo "<td><input type='checkbox' name='reserve[]' value='" . $row['ISBN'] . "'></td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                    echo "</tr>";
                    //$i = $i + 1;
                }
                echo "</table>";
                echo "<input type='submit' name='submit2' value='Reserve' class='button'>";
                echo "</form>";
                echo "</div>";
                $sql = "SELECT COUNT(ISBN) AS total FROM books";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_pages = ceil($row["total"] / 5);
                for($i=1; $i<=$total_pages; $i++)
                {
                    echo "<a href='test_pagination.php?page=".$i."'>".$i."</a> ";
                }
            }
?>