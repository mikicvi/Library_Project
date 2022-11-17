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
		<title>Home Page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<nav class="navtop">
			<div>
				<h1>Library Home</h1>
				<a href="search.php"><i class="fas fa-search"></i>Search / Reserve</a>
				<a href="reserved.php"><i class="fas fa-book"></i>Reserved Books</a>
				<a class="active" href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>
