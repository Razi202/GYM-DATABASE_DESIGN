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
                <h2 class="title">Exercise Page</h2>

                
                <p>Hello <?php echo $_SESSION["id"] ?> ! </p>
                <form action="exercise.php" method="POST" class="the-form">

                    <label for="equipment">Equipment needed</label>
                    <select type="text" name="equipment" id="the_equipment" placeholder="Select the equipment">
                        <option value="Treadmill">Treadmill</option>
                        <option value="GymBike">Gym Bike</option>
                        <option value="PowerTower">Power Tower</option>
                        <option value="PeckDeckMachine">Peck Deck Machine</option>
                        <option value="LegPressMachine">Leg Press Machine</option>
                        <option value="Weights">Weights</option>
                    </select>

                    <label for="Muscle">Muscle</label>
                    <select type="text" name="muscle" id="the_muscle" placeholder="What muscle do you want to work on?">
                        <option value="biceps-triceps">Biceps/Triceps</option>
                        <option value="Thighs">Thighs</option>
                        <option value="Abs">Abs</option>
                        <option value="Chest">Chest</option>
                    </select>
                    <label for="type">Type</label>
                    <select type="text" name="type" id="the_type" placeholder="Enter the type of workout">
                        <option value="Cardio">Cardio</option>
                        <option value="BodyBuilding">Body Building</option>
                        <option value="StaminaBuilding">Stamina Building</option>
                    <select>

                    <input type="submit" value="ENTER INFO" value="Update Record" name = "Insert">

                </form>

            </div><!-- FORM BODY-->

            <div class="form-footer">
                <div>
                    <span></span> <a href="./dailyreport.php">Next</a>
                </div>
            </div>

        </div><!-- FORM CONTAINER -->
    </div>
<?php

if (isset($_POST["Insert"]))
{
    $CNIC=$_SESSION['id'];
    $days=$_SESSION['day'];
    $equip=$_POST["equipment"];
    $muscle=$_POST["muscle"];
    $Type=$_POST["type"];
    $Pid=$_SESSION['pid'];

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

//   create table exercise(eid number(38), cnic number(38), plan_id number(38), days varchar2(100), type varchar2(100), equipment varchar2(100), body_part varchar2(100), FOREIGN KEY(cnic) references signup(cnic), FOREIGN KEY(plan_id) references plan(pid), PRIMARY KEY(eid));
    
    $val = "select COALESCE(MAX(eid), 0) from exercise";
    $val=oci_parse($con, $val); 
    $w=oci_execute($val);
    $x=oci_fetch_array($val, OCI_BOTH+OCI_RETURN_NULLS);
    $new = $x[0];
    $new = $new + 1;

    $query = "insert into exercise values ('$new', '$CNIC', '$Pid', '$days','$Type', '$equip', '$muscle')";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    if($r) 
        { 
            $_SESSION['eid'] = $new;
            $_SESSION['Type'] = $Type;
            $_SESSION['equip'] = $equip;
            echo "Insertion Successful :)"; 
            header("Location: dailyreport.php", true, 301);
        } 
    else 
        { die('Could not Insert :('); }

}

?>
</body>
</html>