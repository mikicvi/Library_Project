<html>
    <head>
        <title>Library</title>
        <!-- link css file -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <?php 
            // require_once 'db.php'; 
            // include 'assets\create_category_table.php'; 
            // include 'assets\create_users_table.php'; 
            // include 'assets\create_books_table.php'; 
            // include 'assets\create_reservations_table.php';
            //include 'assets\sample_data.php'; 
        ?>
    </head>
    <body>
    <nav class="navtop">
			<div>
				<h1>Library</h1>
                <a href="register.php"><i class="fas fa-user"></i>Register</a>
			</div>
		</nav>
        <div class="header-center">
            <h1>Library Login</h1>
        </div>     
        <div class="login">
            <form method="post" action="auth.php">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="submit" value="Login" class=button>
                <p>Not registered yet? <a href="register.php" class = li-underline>Register here</a></p>
            </form>
        </div>
    </body>   
    <footer>
        <div class="footer">
    <p>Vilim Mikic, Library System, 2022</p>
    </div>
    </footer>   
</html>