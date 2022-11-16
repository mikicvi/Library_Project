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

        require_once "db.php";

        // if the user has ticked a book to reserve, update the database, set the reserved value to 1, and insert the ISBN, username and date into the reserved table
        if(isset($_POST['submit']))
        {
            if(isset($_POST['Reserve']))
            {
                $reserve = $_POST['Reserve'];
                foreach($reserve as $ISBN)
                {
                    $sql = "UPDATE books SET Reserved = 1 WHERE ISBN = '$ISBN'";
                    //execute the query
                    $reserve_result = $conn->query($sql);
                    if($reserve_result === TRUE)
                    {
                        // insert the ISBN and the user's username into the reservations table
                        $sql = "INSERT INTO reservations (ISBN, Username, ReservationDate) VALUES ('$ISBN', '" . $_SESSION['username'] . ", date('Y-m-d'))";
                        if($reserve_result === TRUE)
                        {
                            echo "<div class='success'> Book reserved successfully</div>";
                        }
                        else
                        {
                            echo "<div class='error'>Error1 reserving book: " . $conn->error . "</div>";
                        }
                    }
                    else
                    {
                        echo "<div class='error'>Error2 reserving book: " . $conn->error . "</div>";
                    }
                }
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
			<h2>Reservations Page</h2>
            <p>Reserve a book</p>
            <form method="post" action="reserve.php">
                <table>
                    <tr>
                        <th>ISBN</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Edition</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Reserve</th>
                    </tr>
                    <?php
                    // select all the books that are not reserved
                    $sql = "SELECT * FROM books WHERE Reserved = 0";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>" . $row['ISBN'] . "</td>";
                            echo "<td>" . $row['BookTitle'] . "</td>";
                            echo "<td>" . $row['Author'] . "</td>";
                            echo "<td>" . $row['Edition'] . "</td>";
                            echo "<td>" . $row['Year'] . "</td>";
                            echo "<td>" . $row['CategoryID'] . "</td>";
                            echo "<td><input type='checkbox' name='Reserve[]' value='" . $row['ISBN'] . "'></td>";
                            echo "</tr>";
                        }
                    }
                    else
                    {
                        echo "<div class='error'>No books available</div>";
                    }
                    ?>
                </table>
                <input type="submit" name="submit" value="Reserve" class="button">
            </form>
            
            
		</div>
	</body>
</html>







