<?php

    //If the user submitted the form
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //Connect to the database
        include("connection.php");

        //Array for errors
        $errors = array();

        if(empty($_POST['email']))
        {
            $errors[] = 'Forgot to enter your Email <br />';
        }
        else
        {
            $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
        }

        
        if(empty($_POST['pass']))
        {
            $errors[] = 'Forgot to enter your current Password <br />';
        }
        else
        {
            $p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
        }


        //Checks for new password and compare confirmed password
        if(!empty($_POST['pass1']))
        {      
            if($_POST['pass1'] != $_POST['pass2'])
            {
                $errors[] = 'New Password does not match confirmed password <br />';
            }
            else
            {
                $np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
            }

        }
        else
        {
            $errors[] = 'Forgot to enter your new Password <br />';
        }

        


        //No errors
        if(empty($errors))
        {
            //Checking if the user entered the right user/pass
            $q = "SELECT id FROM users WHERE (email='$e' AND password='$p')";
            $r = mysqli_query($dbc, $q);
            $num = mysqli_num_rows($r);
            
            //Gets the user ID where email = $e and password = $p
            if($num == 1)
            {
                //MYSQLI_NUM is for numerical arrays
                $row = mysqli_fetch_array($r, MYSQLI_NUM);

                //Makes UPDATE query
                $q = "UPDATE users SET password='$np' WHERE id='$row[0]'";
                $r = mysqli_query($dbc, $q);

                //If everything is okay
                if(mysqli_affected_rows($dbc) == 1)
                {
                    //Message confirmation
                    echo "Thank you, Your password has been changed.";
                }
                else
                {
                    echo "Your password could not be changed due to a system error";
                }

                //Closes the connection to the database
                mysqli_close($dbc);
            }
            else
            {
                echo "Email and Password do not match our records";
            }
        }
        
        else
        {
            echo "ERROR! The following error(s) occured: <br />";
            foreach($errors as $msg)
            {
                echo $msg;
            }
        }

    }

?>


<h2>Change Password</h2>
<form method="post" action="password.php">
    <p>Email: <input type="text" name="email" size="20" maxlength="50" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" /></p>
    <p>Current Password: <input type="password" name="pass" size="10" maxlength="50" value="<?php if(isset($_POST['pass'])) {echo $_POST['pass'];} ?>" /></p>
    <p>New Password: <input type="password" name="pass1" size="10" maxlength="50" value="<?php if(isset($_POST['pass1'])) {echo $_POST['pass1'];} ?>" /></p>
    <p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="50" value="<?php if(isset($_POST['pass2'])) {echo $_POST['pass2'];} ?>" /></p>
    <p><input type="submit" name="submit" value="Change Password" /></p>
</form>