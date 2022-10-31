<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
    <nav class="navtop">
			<div>
				<h1>Library</h1>
                <a href="index.php"><i class="fas fa-sign-in-alt"></i>Login</a>
			</div>
		</nav>
        <div class="header-center">
            <h1>Library Registration</h1>
        </div>

        <div class = register>
            <form action="register.php" method="post">
                <input type="text" name="firstName" placeholder="First Name">
                <input type="text" name="lastName" placeholder="Last Name">
                <input type="text" name="addressLine1" placeholder="Address Line 1">
                <input type="text" name="addressLine2" placeholder="Address Line 2">
                <input type="text" name="city" placeholder="City">
                <input type="text" name="telephone" placeholder="Telephone">
                <input type="text" name="mobile" placeholder="Mobile (10 numbers)">
                <input type="email" name = "email" placeholder="Email">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password (6 characters)">
                <input type="password" name="password2" placeholder="Confirm Password">
                <input type="submit" name="submit" value="Register"  class = button>
            </form>
            <?php
            //db connection
            require_once 'db.php';
            //check if submitted form is fully filled out
            if(!isset($_POST['username'], $_POST['password'], $_POST['password2'], $_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['addressLine1'], $_POST['addressLine2'], $_POST['city'], $_POST['telephone'], $_POST['mobile']))
            {
                //error message: please fill all of the fileds
                echo"<div class='error'>Please fill out all of the fields above!</div>";
            }
            elseif (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['email']))
            {
                //error message: please fill all of the fileds
                echo"<div class='error'>One or more values missing, please fill out the entire form!</div>";
            }
            else
            {
                //check if the password and confirm password are the same
                if($_POST['password'] != $_POST['password2'])
                {
                    //error message: password and confirm password are not the same
                    echo"<div class='error'>The passwords you entered do not match!</div>";
                }
                elseif (strlen($_POST['password']) != 6) 
                {
                    //error message: password must be 6 characters long
                    echo"<div class='error'>Password must be 6 characters long!</div>";
                }
                else
                {
                    //check if the username already exists
                    if($stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?'))
                    {
                        $stmt->bind_param('s', $_POST['username']);
                        $stmt->execute();
                        $stmt->store_result();
                        if($stmt->num_rows > 0)
                        {
                            //error message: username already exists
                            echo"<div class='error'>Username already exists!</div>";
                        }
                        elseif (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0)
                        {
                            //error message: username is not valid, contains special characters
                            echo"<div class='error'>Username is not valid, please use only letters and numbers!</div>";
                        }
                        else
                        {
                            //check if the email already exists
                            if($stmt = $conn->prepare('SELECT id, password FROM users WHERE email = ?'))
                            {
                                $stmt->bind_param('s', $_POST['email']);
                                $stmt->execute();
                                $stmt->store_result();
                                if($stmt->num_rows > 0)
                                {
                                    //error message: email already exists
                                    echo"<div class='error'>Email already exists!</div>";
                                }
                                elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                                {
                                    //error message: email is not valid
                                    echo"<div class='error'>Email is not valid!</div>"; 
                                }
                                else
                                {
                                    //insert the new user into the database
                                    if($stmt = $conn->prepare('INSERT INTO users (username, password, email, firstName, surname, addressLine1, addressLine2, city, telephone, mobile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'))
                                    {
                                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                        $stmt->bind_param('ssssssssii', $_POST['username'], $password, $_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['addressLine1'], $_POST['addressLine2'], $_POST['city'], $_POST['telephone'], $_POST['mobile']);
                                        $stmt->execute();
                                        //success message: registration successful
                                        echo"<div class='success'>Registration successful, redirecting you to the login page!</div>";
                                        header("refresh:3;url=index.php");
                                    }
                                    else
                                    {
                                        //error message: cant insert into db error
                                        echo"<div class='error'>Could not insert user into database!</div>";
                                    }
                                }
                            }
                            else
                            {
                                //error message: email error
                                echo"<div class='error'>Likely an email error, please check your email formatting</div>";
                            }
                        }
                    }
                    else
                    {
                        //error message: something went wrong
                        echo"<div class='error'>Something went wrong</div>";
                    }
                }
            }
        ?>
        </div>
    </body>
</html>