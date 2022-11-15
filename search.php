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
                <input type="checkbox" name="search" value="title" checked>Search by Title<br>
                <input type="checkbox" name="search" value="author">Search by Author<br>
                <?php
                //connect to the database
                require_once "db.php";

                $sql = "SELECT CategoryDescription FROM category";
                $categories = $conn->query($sql);
                ?>
                <select>
                    <option value="">--- Select Category -- </option>
                    <?php
                    while($row = $categories->fetch_assoc())
                    {
                        echo "<option value='" . $row['CategoryDescription'] . "'>" . $row['CategoryDescription'] . "</option>";
                    }
                    ?>
                </select><br>

                <input type="text" name="searchterm" placeholder="Search Term">
                <input type="submit" name="submit" value="Search">
			
		</div>
	</body>
</html>
