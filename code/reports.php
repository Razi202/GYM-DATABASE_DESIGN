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
                <h2 class="title">Report</h2>

                
                <p>Hello <?php echo $_SESSION["id"] ?> ! </p>
<p><?php


    $CNIC=$_SESSION["id"];
    // $height=$_SESSION["height"];
    // $date=$_POST["date"];
    // $hours=$_POST["hours"];
    // $weight=$_POST["weight"];
    // $calories=$_POST["calories"];
    // $bmi = $weight/($height*$height);

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
  {  } 
else 
  { die('Could not connect to Oracle :( '); } 

//   create table dailyreport(date_ varchar2(100), cnic number(38), hours_worked number(38), calories_burned number(38), weight number(38), bmi number(38), PRIMARY KEY(date_));
    
    $query = "select date_ from dailyreport where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    // $x=oci_fetch_array($query, OCI_BOTH+OCI_RETURN_NULLS);
    // $new = $x;
    $i=1;
    echo "<u><b><br>Date<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }    

    $i=1;
    $query = "select days from plan where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    echo "<u><b><br>Days worked<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }   

    $i=1;
    $query = "select protein from plan where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    echo "<u><b><br>Protein<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }  

    $i=1;
    $query = "select fat from plan where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    echo "<u><b><br>Fat<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }  

    $i=1;
    $query = "select carbo from plan where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    echo "<u><b><br>Carbohydrates<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    } 
    
    $i=1;
    $query = "select equipment from exercise where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    echo "<u><b><br>Equipment used<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }

    $i=1;
    $query = "select body_part from exercise where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    echo "<u><b><br>Muscle worked on<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }

    $i=1;
    $query = "select bmi from dailyreport where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    echo "<u><b><br>BMI<br></u></b>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }

    $query = "select weight from dailyreport where cnic=$CNIC";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    // $x=oci_fetch_array($query, OCI_BOTH+OCI_RETURN_NULLS);
    // $new = $x;
    $i=1;
    echo "<u><b><br>Weight<br></b></u>\n";
    while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS))
    {
        echo "<br>\n" . $i . ". " . $row[0] . "<br>\n";
        $i=$i+1;
    }
    // if($r) 
    //     { 
    //          
    //         // $_SESSION['id']=$CNIC;
    //         // $_SESSION['day'] = $days;
    //         // header("Location: exercise.php", true, 301);
    //     } 
    // else 
    //     { die('Could not Insert :('); }



?></p>
                

            </div><!-- FORM BODY-->

            <div class="form-footer">
                <div>
                    <span>Back to</span> <a href="./login.php">Login</a>
                </div>
            </div>

        </div><!-- FORM CONTAINER -->
    </div>

</body>
</html>