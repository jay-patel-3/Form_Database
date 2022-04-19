


<?php   

    error_reporting(0);

    echo "<br />";
    echo "<h1 style='text-align: center;'>User Deletion</h1>";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //Connect to the database
        include("connection.php");

        $id_user = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
        mysqli_query($dbc, "DELETE FROM users WHERE id='$id_user'");

        echo "<p style='text-align: center; color: red;'><i>User Deleted! You will be missed</i></p>";

    }
    else 
    {
        echo "<h3 style='text-align: center; color: red; '><i>Are you sure?</i></h3>";
    }

?>


<form method="post" action="delete.php" style="text-align: center; ">
    <p>User ID: <input type="text" name="user_id" value="<?php echo $_GET['user_id'] ?>" /><br />
    <p>First Name: <input type="text" name="first_name" value="<?php echo $_GET['fname'] ?>" /><br />
    <p>Last Name: <input type="text" name="last_name" value="<?php echo $_GET['lname'] ?>" /><br />
    <p><input type="submit" name="submit" value="Yes" /></p>
    <p><a href="output.php">My Records</a></p>
</form>