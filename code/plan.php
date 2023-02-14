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
                <h2 class="title">Planning Page</h2>

                
                <p>Hello <?php echo $_SESSION["id"] ?> ! </p>
                <form action="plan.php" method="POST" class="the-form">

                    <label for="days">Days</label>
                    <select type="days" name="days" id="the_days" placeholder="Enter Days to work (weekdays or weekends)">
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        
                    </select>

                    <label for="start-time">Starting time</label>
                    <input type="time" name="start_time" id="the_start_time" placeholder="Enter your starting time">

                    <label for="end-time">Ending time</label>
                    <input type="time" name="end_time" id="the_end_time" placeholder="Enter your ending name">

                    

                    <label for="protein">Protien</label>
                    <input type="number" name="protein" id="protein" placeholder="Enter your protein intake plan">

                    <label for="fat">Fat</label>
                    <input type="number" name="fat" id="fat" placeholder="Enter your fat intake plan">

                    <label for="carbo">Carbohydrate</label>
                    <input type="number" name="carbo" id="carbo" placeholder="Enter your carbohydrate intake plan">

                    <input type="submit" value="ENTER PLAN" value="Update Record" name = "Insert">
                </form>

            </div><!-- FORM BODY-->

            <div class="form-footer">
                <div>
                    <span></span> <a href="./exercise.php">Next</a>
                </div>
            </div>

        </div><!-- FORM CONTAINER -->
    </div>
<?php

if (isset($_POST["Insert"]))
{
    $CNIC=$_SESSION["id"];
    $days=$_POST["days"];
    $start_time=$_POST["start_time"];
    $end_time=$_POST["end_time"];
    $protein = $_POST["protein"];
    $fat = $_POST["fat"];
    $carbo = $_POST["carbo"];
    if (empty($days))
    {
        $days = "Monday";
    }
    if (empty($start_time))
    {
        $start_time = "1300";
    }
    if (empty($end_time))
    {
        $end_time = "1500";
    }
    if (empty($protein))
    {
        $protein = "100";
    }
    if (empty($fat))
    {
        $fat = "100";
    }
    if (empty($carbo))
    {
        $carbo = "100";
    }

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

//   create table plan(pid number(38), cnic number(38), days varchar2(100), start_time varchar2(100), end_time varchar2(100), protein number(38), fat number(38), carbo number(38), FOREIGN KEY (cnic) references signup(cnic), PRIMARY KEY(pid));
    
    $val = "select COALESCE(MAX(pid), 0) from plan";
    $val=oci_parse($con, $val); 
    $w=oci_execute($val);
    $x=oci_fetch_array($val, OCI_BOTH+OCI_RETURN_NULLS);
    $new = $x[0];
    $new = $new + 1;

    $query = "insert into plan values ('$new', '$CNIC','$days','$start_time', '$end_time', '$protein', '$fat', '$carbo')";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    if($r) 
        { 
            echo "Insertion Successful :)"; 
            $_SESSION['id']=$CNIC;
            $_SESSION['day'] = $days;
            $_SESSION['pid'] = $new;
    
            $_SESSION['protein']=$protein;
            $_SESSION['carbo'] = $carbo;
            $_SESSION['fat'] = $fat;
            header("Location: exercise.php", true, 301);
        } 
    else 
        { die('Could not Insert :('); }

}

?>
</body>
</html>