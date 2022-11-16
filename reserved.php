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
            //get the books that the user has reserved
            $sql = "SELECT * FROM reservations WHERE Username = '$username'";
            $result = $conn->query($sql);
            //if there are no books reserved, display a message
            if ($result->num_rows == 0) {
                echo "You have no books reserved.";
            }
            //if there are books reserved, display them
            else
            {
                echo "<table>";
                echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>Author</th>";
                echo "<th>ISBN</th>";
                echo "<th>Reserved by</th>";
                echo "<th>Reserve</th>";
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ISBN"] . "</td>";
                    echo "<td>" . $row["Username"] . "</td>";
                    echo "<td>" . $row["ReservationDate"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }


            ?>
		</div>
	</body>
</html>







