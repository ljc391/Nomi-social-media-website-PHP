<?php
include("mysql_connect.php");
session_start();
if (isset($_SESSION['u_id'])) $u_id = $_SESSION['u_id']; else $u_id='Guest';

    $function = $_POST['function'];

    $log = array();
    $message="";
    $success=false;
    $data='';
    $times='';
    $title='';

    switch($function) {

         case('getState'):

            // if ($stmt = $mysqli->prepare("SELECT n_time FROM notification ORDER BY n_time DESC LIMIT 1")) {
            if ($stmt = $mysqli->prepare("SELECT l_time, r_time FROM logout WHERE u_id = ?")) {
                $stmt->bind_param("s", $u_id);
                $stmt->execute();
                $stmt->bind_result($n_time, $r_time);
                $stmt->fetch();
                $stmt->close();
                //$data = $n_time;
                //$r_time\
                $success = true;
            }

            $response = array('success' => $success, 'n_time' => $n_time, 'r_time' => $r_time,  'message' => $message, 'times' =>$times);
            echo json_encode($response);

             break;
        case('getUsers'):
            // return users with u_pollDate> currentTime - 5 sec

        break;
        case ('notifyUser'):

            $postId = $_POST["postId"];

            $n_time = $_POST['n_time'];
            $r_time = $_POST['r_time'];
            $success = true;

            $query = "SELECT  a.c_id, content.c_title
                     FROM (SELECT DISTINCT p.c_id
                        FROM
                        (SELECT c_id FROM likes WHERE  u_id = ?
                        union
                        SELECT distinct c_id FROM comments  WHERE  u_id = ?) p natural join notification WHERE n_time > ?) a natural join content ";
            /*$query = "SELECT DISTINCT p.c_id
                        FROM
                        (SELECT c_id FROM likes WHERE  u_id = ?
                        union
                        SELECT distinct c_id FROM comments  WHERE  u_id = ?) p natural join notification WHERE n_time > ? ORDER BY n_time ASC";
            */
           if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param("sss", $u_id, $u_id, $r_time);
                $stmt->execute();
                $stmt->bind_result($c_ids, $c_title);
                if (!$stmt->fetch()) {
                  //  $success = true;

                    $message .= $c_ids;
                    $message .= ' no results!';
                    //echo "<p>no recently posts</p>";
                }else{
                    $success = true;
                    $i = 0;
                    $data[$i] = $c_ids;
                   // $times[[$i]] = $times;
                    $title[$i] = $c_title;
                    $i+=1;
                     while ($stmt->fetch()) {

                        $data[$i] = $c_ids;
                        //$times[[$i]] = $times;

                        $title[$i] = $c_title;
                        $i+=1;

                     }

                }

                //$mysqli->close();
            }else{
                $message .= 'nonodatabase';
            }

            $response = array('success' => $success, 'data' => $data,'title' => $title, 'message' => $message);
            echo json_encode($response);


        break;

        case ('updateRtime'):


             if ($stmt = $mysqli->prepare("SELECT COUNT(u_id) FROM logout   WHERE u_id =?")) {


                $stmt->bind_param("s", $u_id);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();
                $message .= $count;

                date_default_timezone_set('America/New_York');
                $now = date('Y-m-d H:i:s');
                    if($count>0){
                        $query = "UPDATE logout SET r_time = '$now' WHERE u_id = '$u_id'";

                        if (mysqli_query($mysqli, $query)) {
                            $success = true;
                            $message = "R time store";
                        } else {

                            $message .=  "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                        }

                    }else{
                        $query = "INSERT INTO logout VALUES ('$u_id',now(), now())";
                        if (mysqli_query($mysqli, $query)) {
                            $success = true;
                            $message = "R time store";
                        } else {

                            $message .=  "Error: " . $sql . "<br>" . mysqli_error($mysqli);
                        }


                    }


                $mysqli->close();
                }

           $response = array('success' => $success, 'data' => $data, 'r_time' => $now, 'message' => $message);

            echo json_encode($response);


        break;



    }


?>