<html>
	<head>
        <?php
        session_start();
        //check if the user is logged in, if not, send them to the login page
        if(!isset($_SESSION['loggedin']))
        {
            header('Location: index.php');
            exit;
        }
        function print5_results($result)
        {
            require_once "db.php";
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
                $i = 0;
                // if there are more than 5 results display button to show more results
                while($row = $result->fetch_assoc() and $i <5)
                {
                    echo "<tr>";
                    echo "<td>" . $row['ISBN'] . "</td>";
                    echo "<td>" . $row['BookTitle'] . "</td>";
                    echo "<td>" . $row['Author'] . "</td>";
                    echo "<td>" . $row['Edition'] . "</td>";
                    echo "<td>" . $row['Year'] . "</td>";
                    // display the category description from the category table
                    echo "<td>" . $row['CategoryDescription'] . "</td>";
                    //if the value is 0, display Not Reserved, if the value is 1, display Reserved 
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
                    $i = $i + 1;
                }
                echo "</table>";
                // if there are more than 5 results display button to show more results
                if($result->num_rows > 5)
                {
                    echo "<form action='' method='post'>";
                    echo "<input type='submit' name='show_more' value='Show More Results'>";
                    echo "</form>";
                }
                echo "<input type='submit' name='submit2' value='Reserve' class='button'>";
                echo "</form>";
                echo "</div>";
            }
            else
            {
                echo "<div class='error'>No results found</div>";
            }
        }
        function print_results($result)
        {
            require_once "db.php";
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
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>";
                    echo "<td>" . $row['ISBN'] . "</td>";
                    echo "<td>" . $row['BookTitle'] . "</td>";
                    echo "<td>" . $row['Author'] . "</td>";
                    echo "<td>" . $row['Edition'] . "</td>";
                    echo "<td>" . $row['Year'] . "</td>";
                    // display the category description from the category table
                    echo "<td>" . $row['CategoryDescription'] . "</td>";
                    //if the value is 0, display Not Reserved, if the value is 1, display Reserved 
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
                }
                echo "</table>";
                echo "<input type='submit' name='submit2' value='Reserve' class='button'>";
                echo "</form>";
                echo "</div>";
            }
            else
            {
                echo "<div class='error'>No results found</div>";
            }
        }

        ?>



		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Search Page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<nav class="navtop">
			<div>
				<h1>Library</h1>
                <a class="active" href="search.php"><i class="fas fa-search"></i>Search / Reserve</a>
                <a href="reserved.php"><i class="fas fa-book"></i>Reserved Books</a>
                <a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Search Page</h2>
            <form action="" method="post">
                <input type="checkbox" name="title_chbx" value="title" >  Search by Title<br>
                <input type="checkbox" name="author_chbx" value="author">  Search by Author<br>
                <select name="category_select" id="searchinput">
                    <option disabled selected="">--- Select Category --- </option>
                    <?php
                    require_once "db.php";
                    $sql = "SELECT CategoryDescription, CategoryID FROM category";
                    $categories = $conn->query($sql);
                    //loop through the categories and display them in the dropdown menu but keep categoryID in the value
                    while($row = $categories->fetch_assoc())
                    {
                        echo "<option value=" . $row['CategoryDescription'] . ">". $row['CategoryDescription'] . "</option>";
                    }
                    ?>
                </select><br>
                <input type="text" name="searchterm" placeholder="Enter search term(s) here">
                <input class="button" type="submit" name="submit" value="Search">
            </form>
            <?php
            // keep the search term and checkboxes selected when the page is refreshed, javascript is used to keep track of the input
            if(isset($_POST['submit']))
            {
                if(isset($_POST['title_chbx']))
                {
                    echo "<script>document.getElementsByName('title_chbx')[0].checked = true;</script>";
                }
                if(isset($_POST['author_chbx']))
                {
                    echo "<script>document.getElementsByName('author_chbx')[0].checked = true;</script>";
                }
                if(isset($_POST['category_select']))
                {
                    echo "<script>document.getElementById('searchinput').value = '" . $_POST['category_select'] . "';</script>";
                }
                if(isset($_POST['searchterm']))
                {
                    echo "<script>document.getElementsByName('searchterm')[0].value = '" . $_POST['searchterm'] . "';</script>";
                }
            }
            ?>
            <?php
            // if the submit button is clicked and the search term contains category
            if(isset($_POST['category_select']))
            {
                $category = $_POST['category_select'];
                $sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE CategoryDescription LIKE '$category'";
                $result = $conn->query($sql);
                print_results($result);

            }
            // if the submit button is clicked and both title and author are checked
            elseif(isset($_POST['title_chbx']) && isset($_POST['author_chbx']))
            {
                //get the search term from the form using the post method and mysqli_real_escape_string to prevent sql injection
                $searchterm = mysqli_real_escape_string($conn, $_POST['searchterm']);
                // replace space with (, '%' ,) to allow partial search on multiple words
                $searchterm = str_replace(' ', '%', $searchterm);
                // search by title and/or author
                $sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE Author LIKE '%$searchterm%' OR BookTitle LIKE '%$searchterm%'";
                $result = $conn->query($sql);
                print_results($result);
            }
            // if the submit button is clicked and the search term contains title
            elseif(isset($_POST['submit']) && isset($_POST['title_chbx']))
            {
                //get the search term from the form
                $searchterm = mysqli_real_escape_string($conn, $_POST['searchterm']);
                // replace space with (, '%' ,) to allow partial search
                $searchterm = str_replace(' ', '%', $searchterm);
                $sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE BookTitle LIKE '%$searchterm%'";
                $result = $conn->query($sql);
                print_results($result);
            }
            // if the submit button is clicked and the search term contains author
            elseif(isset($_POST['submit']) && isset($_POST['author_chbx']))
            {
                //get the search term from the form
                $searchterm = mysqli_real_escape_string($conn, $_POST['searchterm']);
                // replace space with (, '%' ,) to allow partial search on multiple words
                $searchterm = str_replace(' ', '%', $searchterm);
                // select all field from books but get categorydescription from category table, do partial search on author
                $sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE Author LIKE '%$searchterm%'";
                $result = $conn->query($sql);
                print_results($result);
            }
            // if the submit button is clicked and the search term is empty, display error message
            elseif(isset($_POST['submit']) && empty($_POST['searchterm']))
            {
                echo "<div class='error'>Please enter a search term to search for</div>";
            }
            ?>

            <?php
                // connect to the database
                require_once "db.php";
                        // if the user has ticked a book to reserve, update the database, set the reserved value to 1, and insert the ISBN, username and date into the reserved table
                        if(isset($_POST['submit2']))
                        {
                            if(isset($_POST['reserve']))
                            {
                                $reserve = $_POST['reserve'];
                                foreach($reserve as $ISBN)
                                {
                                    $sql = "UPDATE books SET Reserved = 1 WHERE ISBN = '$ISBN'";
                                    //execute the query
                                    $reserve_result1 = $conn->query($sql);
                                    if($reserve_result1 === TRUE)
                                    {   
                                        // insert the ISBN and the user's username into the reservations table
                                        $sql = "INSERT INTO reservations (ISBN, Username) VALUES ('$ISBN', '" . $_SESSION['username'] . "')";
                                        $reserve_result2 = $conn->query($sql);
                                        if($reserve_result2 === TRUE)
                                        {
                                            echo "<div class='success'> Book reserved successfully</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='error'>Error reserving book: " . $conn->error . "</div>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<div class='error'>Error reserving book: " . $conn->error . "</div>";
                                    }
                                }
                            }
                        }
            ?>
        </div>
	</body>
    <!-- prevent the page from reloading when the user clicks the reserve button -->
    <script> if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}</script>
</html>
