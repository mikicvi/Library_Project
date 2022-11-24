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
        ?>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Reserved Books</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<nav class="navtop">
			<div>
				<h1>Library</h1>
                <a href="search.php"><i class="fas fa-search"></i>Search / Reserve</a>
                <a class="active" href="reserved.php"><i class="fas fa-book"></i>Reserved Books</a>
                <a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Reserved books</h2>
            <p>Books currently reserved for you:</p>
            <?php
            //connect to the database
            require_once "db.php";
            //get the username of the user
            $username = $_SESSION['username'];
            //get the books that the user has reserved do join on tables books, reservations and categories
            $sql = "SELECT * FROM reservations JOIN books ON reservations.ISBN = books.ISBN INNER JOIN category ON books.CategoryID = category.CategoryID WHERE reservations.Username = '$username'";
            //$sql = "SELECT * FROM reservations JOIN books WHERE Username = '$username'";
            $result = $conn->query($sql);
            //if there are no books reserved, display a message
            if ($result->num_rows == 0) {
                echo "You have no books reserved.";
            }
            //if there are books reserved, display them
            else
            {
                echo "<div class='table'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>ISBN</th>";
                echo "<th>Book Title</th>";
                echo "<th>Author</th>";
                echo "<th>Edition</th>";
                echo "<th>Year</th>";
                echo "<th>Category</th>";
                echo "<th>Return?</th>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ISBN"] . "</td>";
                    echo "<td>" . $row["BookTitle"] . "</td>";
                    echo "<td>" . $row["Author"] . "</td>";
                    echo "<td>" . $row["Edition"] . "</td>";
                    echo "<td>" . $row["Year"] . "</td>";
                    echo "<td>" . $row["CategoryDescription"] . "</td>";
                    echo "<form action='reserved.php' method='post'>";
                    echo "<td><input type='submit' name='return' value='Return'></td>";
                    echo "<input type='hidden' name='isbn' value='" . $row["ISBN"] . "'>";
                    echo "</form>";
                    echo "<br>";
                    echo "</tr>";
                }
                echo "</table>";
                // if user clicks on return, delete the reservation from the database and set book reserved to 0
                if(isset($_POST['return']))
                {
                    $isbn = $_POST['isbn'];
                    $sql = "DELETE FROM reservations WHERE ISBN = '$isbn' AND Username = '$username'";
                    $conn->query($sql);
                    $sql = "UPDATE books SET Reserved = 0 WHERE ISBN = '$isbn'";
                    $return_result = $conn->query($sql);
                    if($return_result == TRUE)
                    {
                        echo "<div class='success'>Book returned successfully</div>";
                        header("refresh:2;url=reserved.php");
                    }
                    else
                    {
                        echo "<div class='error'>Error returning book.</div>";
                    }
                }
            }


            ?>
		</div>
	</body>
        <!-- prevent the page from reloading when the user clicks the return button -->

        <script> if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}</script>
<footer>
        <div class="footer">
    <p>Vilim Mikic, Library System, 2022</p>
    </div>
    </footer>   
</html>







