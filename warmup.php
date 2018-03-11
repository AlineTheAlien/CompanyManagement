<html>
<head>
    <meta charset="utf-8">
    <title>Query</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Query: <input type="text" name="query" size="50" value="<?php echo $_POST["query"]; ?>">
    <input type="submit" value="Submit">
</form>


<?php
$conn = mysqli_connect("zyc353.encs.concordia.ca", "zyc353_4", "3bunnies", "zyc353_4");
//mysqli_select_db($con,"zyc353_4");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query1 = "SELECT Students.name FROM Students WHERE Students.SID NOT IN (SELECT SID FROM Members);";
$query2 = "SELECT Members.TID, Students.name FROM Members INNER JOIN Students ON Students.SID = Members.SID ORDER BY Members.TID;";
$query3 = "SELECT Students.SID, Members.TID, Students.name FROM Students INNER JOIN Members ON Members.SID = Students.SID LEFT JOIN Demos ON Members.SID = Demos.SID WHERE Demos.SID IS NULL;";
$query4 = "SELECT Teams.TID FROM Teams WHERE noOfMembers < 4;";
$query5 = "SELECT Students.name FROM Students, Members WHERE Students.SID=Members.SID AND Members.TID=4;";
$query6 = "SELECT DISTINCT Demos.TID FROM Demos WHERE Demos.date='2018-01-20';";
$query7 = "SELECT TID, noOfMembers, (4 - noOfMembers) AS capacityToIncrease FROM Teams WHERE noOfMembers < 4;";
$query8 = "SELECT Members.TID FROM Students, Members WHERE Students.name='Ideawin Koun' AND Students.SID = Members.SID;";
$query9 = "SELECT Students.name, Members.SID FROM Students, Members WHERE Students.SID = Members.SID AND Members.TID = (SELECT Members.TID FROM Students, Members WHERE Students.name='Nassim El Sayed' AND Students.SID = Members.SID);";


$sql = $_POST["query"];
executeQuery($sql, $conn);
if (empty($sql)) {
    executeQuery($query1, $conn);
    executeQuery($query2, $conn);
    executeQuery($query3, $conn);
    executeQuery($query4, $conn);
    executeQuery($query5, $conn);
    executeQuery($query6, $conn);
    executeQuery($query7, $conn);
    executeQuery($query8, $conn);
    executeQuery($query9, $conn);
}

function executeQuery($query, $conn)
{
    echo($query);
    echo "<br>";
    if (!empty($query)) {
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $k => $v) {
                    echo $k . "->" . $v . " ";
                }
                echo "<br>";
            }
            echo "<br>";
            echo "<br>";
        } else {
            echo "0 results";
        }
    }
}


?>
</body>
</html>
