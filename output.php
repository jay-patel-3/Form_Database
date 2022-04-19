
<?php

    //Title
    echo "<h2 align='center'>Control Panel</h2>";
    echo "<br />";


    //Outputting values on the webpage

    include("connection.php");


    //Number of records displayed per page
    $display = 4;

    //Determines how many pages there are per-display
    if(isset($_GET['p']) && is_numeric($_GET['p']))
    {
        //Already determined
        $pages = $_GET['p'];
    }
    
    else
    {
        //Needs to be determined

        $q = "SELECT COUNT(id) FROM users";
		$r = mysqli_query($dbc, $q);
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
		$records = $row[0];
		
		//Calculate the number of pages
		if($records > $display)
        {
			//More than one page
			$pages = ceil($records/$display);
		
		}else
        {
		
			$pages = 1;
			
		}
    }
    

    //Determines where in the database to return results
    if(isset($_GET['s']) && is_numeric($_GET['s']))
    {
        $start = $_GET['s'];
    }
    else
    {
        $start = 0;
    }




    //New Query
    $q = "SELECT last_name, first_name, email, DATE_FORMAT(register_date, '%M %d, %Y %T') AS dr, id FROM users ORDER BY register_date ASC LIMIT $start, $display";
   
    //The * grabs all the values from the database
    $r = mysqli_query($dbc, $q);

    //Count the number of returned rows
    $num = mysqli_num_rows($r);


    //Display Records of rows returned
    if($num > 0)
    {
        //Outputting Database
        echo "<p align='center'><a href='order.php'><b>Order By Name</b></a></p>";
        echo "<p align='center'><a href='userform.php'><b>Form</b></a></p>";
        echo "<br />";
        include('navbar.php');
        echo "<br />";
        echo "<p align='center'><b>Users: &nbsp</b>$num</p>";

        //Make table
        echo "<table align='center' border='1' cellspacing='3' cellpadding='3' width='75%'>
        <tr style='font-size:19px; color:green;'>
            <td align='left'><b>Edit</b></td>
            <td align='left'><b>Delete</b></td>
            <td align='left'><b>Name</b></td>
            <td align='left'><b>Email</b></td>
            <td align='left'><b>Date Registered</b></td>
        </tr>";


        //While loop for associative array (Values: rgistration_date, first_name, last_name)
        while($row = mysqli_fetch_array($r))
        {
            //output values from associative array:
            echo "<tr>
                    <td align='left'><a href='edit.php?user_id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."&lemail=".$row['email']."'>Edit</a></td>
                    <td align='left'><a href='delete.php?user_id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."'>Delete</a></td>
                    <td align='left'>".$row['last_name'].", ".$row['first_name']."</td>
                    <td align='left'>".$row['email']."</td>
                    <td align='left'>".$row['dr']."</td>
                 </tr>";
        }

        echo "</table>";
    }
    else
    {
        "No users currently";
    }

    mysqli_close($dbc);



    //Links to other pages for pagnation
    if($pages > 1)
    {
        echo "<br /><p><center>";

        //Determining what page the script is
        $current_page = ($start/$display) + 1;

        //If not the first page, create previous link
        if($current_page != 1)
        {
            echo '<a href="output.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous </a> ';        
        }

        //Make all numbered pages
        for($i = 1; $i <= $pages; $i++)
        {
            if($i != $current_page)
            {
                echo '<a href="output.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '" style="text-decoration:none;">' .' '. $i.' '. '</a>';            
            }
            else
            {
                echo $i . '';
            }
        }

        //If it's not the last page, make a next button
        if($current_page != $pages)
        {
            echo '<a href="output.php?s=' . ($start + $display) . '&p=' . $pages . '"> Next</a>';        
        }
       
    } 

    echo "</center>";
?>