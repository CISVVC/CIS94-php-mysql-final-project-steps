<!--
The following HTML is what renders the form.  Since this
script is also the processing script for adding a list to 
the database, the action of the form is calling the same
script.  This is one of a few different ways that processing
data coming to the web server application from a client (the web browser).  This method is fairly safe as long as the data
coming from the web server is "sanitized", meaning we don't insert it into the database until we have cleaned it.
-->
<!DOCTYPE html>
<html>
<body>

<h2>Add a List</h2>

<form action="insertlist.php" method="post">
List Description: <input type="text" name="description">
<input type="submit">
</form>


<!--
The following PHP code is for processing the data coming from the form.
This code will also select all data from the list table of the tasklist 
database and will display the data in a table.  The example code in this repository
display.php has some good ideas for how to display the code.  Put it after the 
"filter and insert into the database" step 
-->
<?php
include "connectdb.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tasklist";

// Create connection
$conn = connectdb($servername, $username, $password, $dbname);

/* 
    1.  Check if there is data in the $_POST array
        We will be using the filter functions which 
        do a pretty good job of filtering out potentially dangerous characters and possible attacks such as cross site scripting.
    2.  If there is data in the $_POST array, clean it and 
        prepare the SQL statement
    
*/
// Step:  filter and insert data into the database
if(filter_has_var(INPUT_POST,'description'))
{
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sql = "INSERT INTO list(id, description) VALUES (NULL,'$description')";

    if ($conn->query($sql) === TRUE) {
        print "New list record successfully created";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

/*
    @Student Code@
    Put the list display code after this comment, this will display the list as a table.
*/
    
<?php    
$conn->close();
?>
    
</body>
</html>
