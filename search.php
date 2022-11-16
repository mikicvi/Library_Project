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
                echo "</tr>";

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
                    //if the value is 0, display Not Reserved, if the value is 1, display Reserved, the value is retrieved from the database and is boolean, suppress the notice 
                    echo "<td>" . @($row['Reserved'] == 0 ? "Not Reserved" : "Reserved") . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
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
                <a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Search Page</h2>
            <!-- Search form that will allow user to search in number of ways (checkbox) - by book title and/or author(including partial search on both) and by category description in dropdown menu(category to be retrieved from the database(by using select)) -->
            <form action="search.php" method="post">
                <input type="checkbox" name="title_chbx" value="title" >Search by Title<br>
                <input type="checkbox" name="author_chbx" value="author">Search by Author<br>
                <select name="category_select" id="searchinput">
                    <option disabled selected="">--- Select Category -- </option>
                    <?php
                    require_once "db.php";
                    $sql = "SELECT CategoryDescription, CategoryID FROM category";
                    $categories = $conn->query($sql);
                    //loop through the categories and display them in the dropdown menu but keep categoryID in the value
                    while($row = $categories->fetch_assoc())
                    {
                        echo "<option value=" . $row['CategoryID'] . ">". $row['CategoryDescription'] . "</option>";
                    }
                    ?>
                </select><br>
                <input type="text" name="searchterm" placeholder="Search Term">
                <input type="submit" name="submit" value="Search">
            </form>	
            <?php
            // if the submit button is clicked and the search term is empty, display error message
            if(isset($_POST['submit']) && empty($_POST['searchterm']))
            {
                echo "<div class='error'>Please enter a search term to search for</div>";
            }
            
            // if the submit button is clicked and the search term contains title
            elseif(isset($_POST['submit']) && isset($_POST['title_chbx']))
            {
                //get the search term from the form
                $searchterm = $_POST['searchterm'];
                // replace space with (, '%' ,) to allow partial search
                $searchterm = str_replace(' ', '%', $searchterm);
                $sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE BookTitle LIKE '%$searchterm%'";
                $result = $conn->query($sql);
                // if the result is not empty
                print_results($result);
            }
            // if the submit button is clicked and the search term contains author
            elseif(isset($_POST['submit']) && isset($_POST['author_chbx']))
            {
                //get the search term from the form
                $searchterm = $_POST['searchterm'];
                // replace space with (, '%' ,) to allow partial search
                $searchterm = str_replace(' ', '%', $searchterm);
                // select all field from books but get categorydescription from category table
                $sql = "SELECT * FROM books INNER JOIN category ON books.CategoryID = category.CategoryID WHERE Author LIKE '%$searchterm%'";
                //$sql = "SELECT * FROM books WHERE Author LIKE '%$searchterm%'";
                $result = $conn->query($sql);
                print_results($result);
                }
            ?>
            
		</div>
	</body>
</html>
