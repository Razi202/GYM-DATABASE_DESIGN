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
                <h2 class="title">Sign Up Page</h2>

                

                <form action="signup.php" method="POST" class="the-form">
                    <label for="cnic">CNIC</label>
                    <input type="number" name="cnic" id="the_cnic" placeholder="Enter your CNIC">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="the_email" placeholder="Enter your email">

                    <label for="First-name">First name</label>
                    <input type="text" name="first_name" id="the_first_name" placeholder="Enter your first name">

                    <label for="Last-name">Last name</label>
                    <input type="text" name="last_name" id="the_last_name" placeholder="Enter your last name">

                    <label for="gender">Gender</label>
                    <input type="text" name="gender" id="the_gender" placeholder="Enter your gender">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="the_password" placeholder="Enter your password">

                    

                    <label for="Age">Age</label>
                    <input type="text" name="age" id="the_age" placeholder="Enter your Age">

                    <label for="Height">Height</label>
                    <input type="number" step="any" name="height" id="the_height" placeholder="Height">

                    <input type="submit" value="SIGN UP" value="Update Record" name = "Insert">

                </form>

            </div><!-- FORM BODY-->

            <div class="form-footer">
                <div>
                    <span>Already have an account?</span> <a href="./login.php">Login</a>
                </div>
            </div><!-- FORM FOOTER -->

        </div><!-- FORM CONTAINER -->
    </div>
<?php

if (isset($_POST["Insert"]))
{
    $CNIC=$_POST["cnic"];
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $gender=$_POST["gender"];
    $height=$_POST["height"];
    
    $AGE=$_POST["age"];
    $password=$_POST["password"];
    $email = $_POST["email"];

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

//   create table signup(CNIC number(38), first_name varchar2(200) not null, last_name varchar2(200) not null, email varchar2(100) not null, password varchar2(100) not null, gender varchar2(20) not null, height number(20, 2), age number(20) not null,AGE number(38) not null, PRIMARY KEY (CNIC));
    $query="Select cnic from signup where CNIC ='$CNIC'";
      $query=oci_parse($con, $query); 
      $w=oci_execute($query);
      $row = oci_fetch_array($query, OCI_BOTH+OCI_RETURN_NULLS);

      if (count($row)>1)
      {
          echo "ID already exists";
      }
else{
    
    $query = "insert into signup values ('$CNIC','$first_name','$last_name', '$email', '$password', '$gender','$height','$AGE')";
    $query_id = oci_parse($con, $query);
    $r = oci_execute($query_id);
    if($r) 
        { 
            echo "Insertion Successful :)"; 
            $_SESSION['height']=$height;
        } 
    else 
        { die('Could not Insert :('); }
}

}

?>
</body>
</html>