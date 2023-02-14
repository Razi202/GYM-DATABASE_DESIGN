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
                <h2 class="title">Log In Page</h2>


                <form action="./login.php" class="the-form" method="POST">

                <label for="cnic">CNIC</label>
                    <input type="number" name="cnic" id="the_cnic" placeholder="Enter your CNIC">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">

                    <input type="submit" value="LOG IN" value="Update Record" name = "Insert">

                </form>

            </div><!-- FORM BODY-->

            <div class="form-footer">
                <div>
                    <span>Don't have an account?</span> <a href="./signup.php">Sign Up</a>
                </div>
            </div><!-- FORM FOOTER -->

        </div><!-- FORM CONTAINER -->
    </div>
<?php

if (isset($_POST["Insert"]))
{
    $CNIC=$_POST["cnic"];
    $password=$_POST["password"];
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

//   create table signup(CNIC number(38), first_name varchar2(200), last_name varchar2(200), email varchar2(100), password varchar2(100), gender varchar2(20), height number(20), BMI number(38),AGE number(38), PRIMARY KEY (CNIC));
    $query="Select cnic from signup where CNIC ='$CNIC' AND password='$password'";
      $query=oci_parse($con, $query); 
      $w=oci_execute($query);
      $row = oci_fetch_array($query, OCI_BOTH+OCI_RETURN_NULLS);
      
      if (count($row) > 1)
      {
          echo "LOGGED IN";
          $_SESSION['id']=$CNIC;
          header("Location: plan.php", true, 301);
      }
      else
      {
          echo "No such ID exists";
      }

}

?>
</body>
</html>