<?php

error_reporting(0);

include("connection.php");

//Grabs email and password values from login form
//The trim() function avoids whitespaces here
$login_email = mysqli_real_escape_string($dbc, trim($_POST['login_email']));
$login_password = mysqli_real_escape_string($dbc, $_POST['login_password']);


//Creates the query and number of rows returned from the query
$query = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$login_email."'");
$numrows = mysqli_num_rows($query);




	if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Email and Password Validation
        //Checks if there is a row with that email
		if($numrows != 0)
		{

            //Grabs the email and password from that row returned before
			while($row = mysqli_fetch_array($query))
            {
			
				$dbemail = $row['email'];
				$dbpass = $row['password'];
				$dbfirstname = $row['first_name'];
				
			}
			
			//Checks if email and password are equal to the returned row
			if($login_email==$dbemail)
            {
				if($login_password==$dbpass)
                {				
					echo "<p>Welcome ".$dbfirstname.", you will be redirected to the control panel in a few seconds</p> <br />";	
					header('Refresh: 3; URL=output.php');	
				}
                else
                {
					echo "your password is incorrect!  <a href='index.php'>Go back to the login form</a>";
				}
			}
            else
            {			
				echo "your email is incorrect! <a href='index.php'>Go back to the login form</a>";			
			}	
		}
		
		else
        {
		    echo "Invalid credentials! If you are not registered please register <a href='userform.php'>Here</a>";
		}

	}
	else
    {
		echo "Please Login...";
	}

	?>




