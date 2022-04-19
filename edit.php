<?php   
    
    //Handles errors like 'Undefined Array Key', etc
    error_reporting(0);

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //Connect to the database
        include("connection.php");

        $idnow = $_POST['userid'];
        $demail = $_POST['xemail'];
        $ffname = $_POST['firstname'];
        $llname = $_POST['lastname'];

        $q = "UPDATE users SET first_name='$ffname', last_name='$llname', email='$demail' WHERE id='$idnow'";        
        $r = mysqli_query($dbc, $q);

        if(mysqli_affected_rows($dbc) == 1)
        {
            echo "User Updated";
        }
        else
        {
            echo "Error, Something is wrong";
        }
    }
?>



<form method="post" action="edit.php" style="text-align: center; ">
    <h1>Edit User</h1>
    <p><input type="hidden" name="userid" size="20" maxlength="50" value="<?php echo $_GET['user_id']; ?>" /></p>
	<p>First Name: <input type="text" name="firstname" size="20" maxlength="50" value="<?php echo $_GET['fname']; ?>" /></p>
	<p>Last Name: <input type="text" name="lastname" size="20" maxlength="50" value="<?php echo $_GET['lname']; ?>" /></p>
	<p>Email: <input type="text" name="xemail" size="20" maxlength="50" value="<?php echo $_GET['lemail']; ?>" /></p>
	<p><input type="submit" name="submit" value="Save Changes" /></p>
    <a href="output.php">My Records</a>
</form>


