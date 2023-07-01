<?php
    // link css file
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";
    session_start();
    require_once "db.php";
    // Check connection
    if ($conn->connect_error) 
    {
        die("<div class='error'>Connection failed: " . $conn->connect_error . "</div>");
    }

    if ( !isset($_POST['username'], $_POST['password']) ) {
        // Could not get the data that should have been sent.
        exit('Please fill both the username and password fields!');
    }

    //prepare the sql statement to prevent sql injections
    if ($stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        //store result for error checking
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if (password_verify($_POST['password'], $password)) {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                // set session time out to 60 minutes if no activity


                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $_POST['username'];
                $_Session['start'] = time();
                $_Session['expire'] = $_Session['start'] + (60 * 60);
                header('Location: home.php');
            } else {
                // Incorrect password
                echo "<div class='error'>Incorrect password!</div>";
                echo "<div class='error'>Error log: " . $conn->error . "</div>";
                //stay on the same page
                header('Refresh: 2; URL = index.php');
            }
        } else {
            // Incorrect username
            echo "<div class='error'>Incorrect Username!</div>";
            header('Refresh: 2; URL = index.php');
        }
        $stmt->close();
    }
?>