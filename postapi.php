<?php
include("mysql_connect.php");
session_start();
 if (isset($_SESSION['u_id'])) $u_id = $_SESSION['u_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $message="";
    $success=false;
    $data='';

    if (!empty($_POST["action"])) {
        $action = $_POST["action"];
    }

    switch ($action){
        case "signin":

            if (empty($_POST["userid"])) {
                $message = "ID is required!";
            } else {
                $userid = $_POST["userid"];
            }
            if (empty($_POST["pwd"])) {
                $message = "Password is required!";
            } else {
                $pwd = $_POST["pwd"];
            }

            if ((!empty($userid)) && (!empty($pwd))) {
                if ($stmt = $mysqli->prepare("SELECT u_pwd, u_name FROM user WHERE u_id = ?")) {
                    $stmt->bind_param("s", $userid);
                    $stmt->execute();
                    $stmt->bind_result($u_pwd, $u_name);
                    $stmt->fetch();
                    $stmt->close();
                    if (!$u_pwd || $u_pwd !== md5($pwd)) {
                        $message = "Invalid username or password!";
                    } else {
                        $_SESSION['u_id'] = $userid;

                        $_SESSION['u_name'] = $u_name;
                        $success = true;
                        //$data = array('email' => $u_email);
                    }


                    $mysqli->close();
                }
            }
        break;
        case "signup":

            if (empty($_POST["userid"])) {
                $message = "ID is required!";
            } else {
                $userid = $_POST["userid"];
            }

            if (empty($_POST["pwd"])) {
                $message = "Password is required!";
            } else {
                $pwd = md5($_POST["pwd"]);
            }
            if (empty($_POST["usern"])) {
                $message = "User name is required!";
            } else {
                $usern = $_POST["usern"];
            }
            if (empty($_POST["email"])) {
                $message = "Email is required!";
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
                    $success = true;
                    } else {

                        $message = "Invalid username or password!";
                    }
                $mysqli->close();
            }


        break;
        case "postForm":
            if (empty($_POST["title"])) {
                $message .= "Title is required!";
            } else {
                $title = $_POST["title"];
            }

            if (empty($_POST["content"])) {
                $message .= "Content is required!";
            } else {
                $content = $_POST["content"];
            }

            if ((!empty($title)) && (!empty($content)) ) {

                if ($stmt3 = $mysqli->prepare("SELECT MAX(c_id) FROM content")){
                  $stmt3->execute();
                  $stmt3->bind_result($result);
                  $stmt3->fetch();
                  $i = $result+1;
                  $stmt3->close();
                }
                $query = "INSERT INTO content VALUES ('$i','$title','$content','null');";
                if (mysqli_query($mysqli, $query)) {
                    $success[0] = true;
                    } else {

                        $message = "db err!";
                    }

                $query2 = "INSERT INTO post VALUES ('$u_id','$i',now());";
                if (mysqli_query($mysqli, $query2)) {
                    $success[1] = true;
                    } else {

                        $message = "db err!";
                    }
                $mysqli->close();
            }



        break;
        case "postComment":
            if (empty($_POST["text"])) {
                $message = "Comment is required!";
            } else {
                $text = $_POST["text"];
            }
            if (empty($_POST["postId"])) {
                $message = "PostId is required!";
            } else {
                $postId = $_POST["postId"];
            }
            if (!empty($text)){
                $query = "INSERT INTO comments VALUES ('$u_id','$postId',now(), '$text');";
                if (mysqli_query($mysqli, $query)) {
                    $success = true;

                } else {

                    $message .=  "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                }
                $query2 = "INSERT INTO notification VALUES ('$postId',now());";
                if (mysqli_query($mysqli, $query2)) {
                    $success = true;

                } else {

                    $message .=  "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                }

            }





        break;
        case "likeContent":
            if (empty($_POST["postId"])) {
                $message = "PostId is required!";
            } else {
                $postId = $_POST["postId"];
                $data .= $postId;
            }


            if ($stmt = $mysqli->prepare("SELECT l_date FROM likes WHERE c_id = ? AND u_id = ?")) {
                $stmt->bind_param("ss", $postId, $u_id);
                $stmt->execute();
                $stmt->bind_result($l_date);
                $stmt->fetch();
                $stmt->close();
                if (!$l_date ) {
                    $message .= "no result insert";
                    $query = "INSERT INTO likes VALUES ('$u_id','$postId',now());";
                    mysqli_query($mysqli, $query);
                    $data ="insert";
                } else {
                    $success = true;
                    $message = "find result delete";
                    $message .= $u_id;
                    $message .= $postId;
                    $query = "DELETE FROM likes WHERE u_id = '$u_id' AND c_id = '$postId'";
                    mysqli_query($mysqli, $query);
                    $data ="delete";

                    //$data = array('email' => $u_email);
                }


                $mysqli->close();
            }



        break;
        case 'signout':
            unset($_SESSION['u_id']);
            $success=true;
        break;
        case "userTimestamp":


                if ($stmt = $mysqli->prepare("SELECT COUNT(u_id) FROM logout   WHERE u_id =?")) {


                $stmt->bind_param("s", $u_id);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();
                $message .= $count;


                    if($count>0){
                        $query = "UPDATE logout SET l_time = now() WHERE u_id = '$u_id'";

                        if (mysqli_query($mysqli, $query)) {
                            $success = true;
                            $message = "time store";
                        } else {

                            $message .=  "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                        }

                    }else{
                        $query = "INSERT INTO logout VALUES ('$u_id',now(), now())";
                        if (mysqli_query($mysqli, $query)) {
                            $success = true;
                            $message = "time store";
                        } else {

                            $message .=  "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                        }


                    }


                $mysqli->close();
                }




        break;

        default:
            $message="unknown action";
    }





    $response = array('success' => $success, 'data' => $data, 'message' => $message);
    echo json_encode($response);



}else{
    echo('POST required');
}
?>