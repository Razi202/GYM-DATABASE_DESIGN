<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Login Page Template - W3jar.Com</title>
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style-with-prefix.css">
    <style>
        .srouce{
            text-align: center;
            color: #ffffff;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="form-container">

            <h1>FitMit</h1>

            <div class="form-body">
                <h2 class="title">Daily Report</h2>

                
                <p>Hello <?php echo $_SESSION["id"] ?> ! </p>
                <form action="dailyreport.php" method="POST" class="the-form">

                    <label for="date">Date</label>
                    <input type="date" name="date" id="the_date" placeholder="Enter Date you worked on">

                    <label for="hours">Hours worked</label>
                    <input type="number" name="hours" id="the_hours" placeholder="Enter hours you worked">

                    <label for="calories">Calories burned</label>
                    <input type="number" name="calories" id="the_calories" placeholder="Enter number of calories burned">

                    <label for="weight">Weight</label>
                    <input type="number" name="weight" id="the_weight" placeholder="Enter your weight">

                    <input type="submit" value="ENTER REPORT" value="Update Record" name = "Insert">

                </form>
                <p>
                BMI : 
                <?php 
                $CNIC=$_SESSION["id"];
                $height=$_SESSION['height'];
                $date=$_POST["date"];
                $hours=$_POST["hours"];
                $weight=$_POST["weight"];
                $calories=$_POST["calories"];
                $bmi = $weight/($height*$height);

                echo $bmi;
                ?>
                </p>
                

            </div><!-- FORM BODY-->

            <div class="form-footer">
                <div>
                    <span></span> Check <a href="./reports.php">report.</a>
                </div>
            </div>

        </div><!-- FORM CONTAINER -->
    </div>
<?php

if (isset($_POST["Insert"]))
{
    $CNIC=$_SESSION["id"];
    $height=$_SESSION["height"];
    $date=$_POST["date"];
    $hours=$_POST["hours"];
    $weight=$_POST["weight"];
    $calories=$_POST["calories"];
    $bmi = $weight/($height*$height);

    $db_sid = 
"(DESCRIPTION =
(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
(CONNECT_DATA =
  (SERVER = DEDICATED)
  (SERVICE_NAME = Razi)
)
)";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 

$db_user = "system";   // Oracle username e.g "scott"
$db_pass = "Deviljin123";    // Password for user e.g "1234"
$con = oci_connect($db_user,$db_pass,$db_sid); 
if($con) 
  { echo "Razi Haider 19I-1762 Oracle Connection Successful :)"; } 
else 
  { die('Could not connect to Oracle :( '); } 

//   create table dailyreport(date_ varchar2(100), cnic number(38), hours_worked number(38), calories_burned number(38), weight number(38), bmi number(38), PRIMARY KEY(date_));
    
    
    $query = "insert into dailyreport values('$date', '$CNIC', '$hours', '$calories', '$weight', '$bmi')";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    if($r) 
        { 
            echo $height;
            echo "Insertion Successful :)"; 
            // $_SESSION['id']=$CNIC;
            // $_SESSION['day'] = $days;
            // header("Location: exercise.php", true, 301);
        } 
    else 
        { die('Could not Insert :('); }

}

?>
</body>
</html>