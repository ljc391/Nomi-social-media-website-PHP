<?php
include("mysql_connect.php");
session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["userid"])) {
            $useridErr = "ID is required!";
        } else {
            $userid = $_POST["userid"]; 
        } 
 
        if (empty($_POST["pwd"])) {
            $pwdErr = "Password is required!";
        } else {
            $pwd = md5($_POST["pwd"]);
        } 
        if (empty($_POST["usern"])) {
            $usernErr = "User name is required!";
        } else {
            $usern = $_POST["usern"];
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required!";
        } else {
            $email = $_POST["email"];
        }
        if (empty($_POST["checked"])) {
           // $cheErr = "Need to check it!";
        }  
       
        if ((!empty($userid)) && (!empty($pwd)) && (!empty($usern)) && (!empty($email))) {
            $query = "INSERT INTO user VALUES ('$userid','$pwd','$usern','$email', now());";
            if (mysqli_query($mysqli, $query)) {   
                $_SESSION['u_id'] = $userid;
                 echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
                } else { 
                     

                $Err = "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                echo $res; 
                }
        }
    }
?>