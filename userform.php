<?php

    //Processing Form

    //CRUD (Create, Read, Update, Delete) is also going to be used here

    //If the post has been submitted with the post method, do this
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $comments = $_POST['comments'];
        $password = $_POST['password'];

        //To check of these variables have any values in it
        if(!empty($fname) && !empty($lname) && !empty($email) && !empty($gender) && !empty($age) && !empty($comments) && !empty($password))
        {
            include('connection.php');
            mysqli_query($dbc, "INSERT INTO users(first_name, last_name, email, gender, age, comments, password, register_date) VALUES('$fname', '$lname', '$email', '$gender', '$age', '$comments', '$password',NOW())");
            $registered = mysqli_affected_rows($dbc);
            
            // echo $registered ." row is affected, everything is up to date";
            echo "Hello ".$fname .", "." You can now proceed to the Login Page :)";
        }
        else
        {
            echo "<h2 style='color:red;'>ERROR: Please complete all fields</h2>";
        }
    }
    else 
    {
        echo "<h2>Validation Form Needed</h2>";
    }
?>


<html>
    <head>
        <title></title>
    </head>

    <body>
       <!--Including/Importing php files-->

       <!--Require or Include can be used. The 
       only differences is that Require can give 
       an error message--> 

       <form action="userform.php" method="post">
            <p>First Name: <input type="text" name="fname" size="20" maxlength="50" /></p>
            <p>Last Name: <input type="text" name="lname" size="20" maxlength="50" /></p>
            <p>Email: <input type="text" name="email" size="40" maxlength="50" />
            <p>Gender: <input type="radio" name="gender" value="M" /> Male 
            <input type="radio" name="gender" value="F" /> Female</p>
            <p>Age:<select name="age">
                        <option value="0-29">Under 30</option>
                        <option value="30-60">Between 30 and 60</option>
                        <option value="60+">Over 60</option>
                </select></p>
            <p>Comments:<br /><textarea name="comments" rows="3" cols="40" maxlength="200"></textarea></p>
            <p>Password:<input type="password" name="password" maxlength="50"></p>		
            <p><input type="submit" name="submit" value="Submit" /></p>	   
	    </form>

        <!-- <a href="output.php">Records from the database</a> -->
        <a href="index.php">Login</a>
    </body>
</html>


