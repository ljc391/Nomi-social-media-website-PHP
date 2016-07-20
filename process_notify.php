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

    switch($function) {

         case('getState'):

             if ($stmt = $mysqli->prepare("SELECT n_time FROM notification ORDER BY n_time DESC LIMIT 1")) {
                $stmt->execute();
                $stmt->bind_result($n_time);
                $stmt->fetch();
                $stmt->close();
                $log['n_time'] = $n_time;
            }

            echo json_encode($log);

             break;
        case('getUsers'):
            // return users with u_pollDate> currentTime - 5 sec

        break;
        case ('notifyUser'):

            $postId = $_POST["postId"];

            $n_time = $_POST['n_time'];
            $success = true;
            $query = "SELECT p.c_id, notification.n_time
                        FROM
                        (SELECT c_id FROM likes WHERE  u_id = ?
                        union
                        SELECT distinct c_id FROM comments  WHERE  u_id = ?) p natural join notification WHERE n_time > ? ORDER BY n_time ASC";

           if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param("sss", $u_id, $u_id, $n_time);
                $stmt->execute();
                $stmt->bind_result($c_ids, $times);
                if (!$stmt->fetch()) {
                  //  $success = true;

                    $message .= $c_ids;
                    $message .= ' no results!';
                    echo "<p>no recently posts</p>";
                }else{
                    $success = true;
                    $i = 0;
                    $data[$i] = $c_ids;
                    $times[[$i]] = $times;
                    $i+=1;
                     while ($stmt->fetch()) {

                        $data[$i] = $c_ids;
                        $times[[$i]] = $times;
                        $i+=1;

                     }

                }

                //$mysqli->close();
            }else{
                $message .= 'nonodatabase';
            }

            $response = array('success' => $success, 'data' => $data, 'message' => $message, 'times' =>$times);
            echo json_encode($response);


        break;



    }


?>