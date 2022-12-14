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
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Library</h1>
                <a href="search.php"><i class="fas fa-search"></i>Search / Reserve</a>
                <a href="reserved.php"><i class="fas fa-book"></i>Reserved Books</a>
                <a href="home.php"><i class="fas fa-home"></i>Home</a>
                <a class="active" href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
        <?php
        require_once 'db.php';
        // We don't have the password or email info stored in sessions so instead we can get the results from the database.
        $stmt = $conn->prepare('SELECT password, email, firstName, surname, addressLine1, addressLine2, city, mobile FROM users WHERE id = ?');
        // In this case we can use the account ID to get the account info.
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($password, $email, $firstName, $surname, $addressLine1, $addressLine2, $city, $mobile);
        $stmt->fetch();
        $stmt->close();
        ?>

		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
                    <tr>
                        <td>First Name:</td>
                        <td><?=$firstName?></td>
                    </tr>
                    <tr>
                        <td>Surname:</td>
                        <td><?=$surname?></td>
                    </tr>
                    <tr>
                        <td>Address Line 1:</td>
                        <td><?=$addressLine1?></td>
                    </tr>
                    <tr>
                        <td>Address Line 2:</td>
                        <td><?=$addressLine2?></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><?=$city?></td>
                    </tr>
                    <tr>
                        <td>Mobile:</td>
                        <td><?=$mobile?></td>
                    </tr>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
    <footer>
        <div class="footer">
    <p>Vilim Mikic, Library System, 2022</p>
    </div>
    </footer>   
</html>