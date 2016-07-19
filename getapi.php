<?php
include("mysql_connect.php");
session_start();
 if (isset($_SESSION['u_id'])) $u_id = $_SESSION['u_id'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $message="";
    $success=false;
    $data='';

    if (!empty($_GET["action"])) {
        $action = $_GET["action"];
    }else{
        $message ="no action";
    }

    switch ($action){
        case "loadPostComment":

            if (empty($_GET["postId"])) {
                $message = "postID is required!~!";
            } else {
                $postId  = $_GET["postId"];
            }
            $query = "SELECT u_name,c_ctext FROM comments NATURAL JOIN user WHERE c_id = ? ORDER BY c_date ASC";
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param("s", $postId);
                $stmt->execute();
                $stmt->bind_result($u_cname, $c_ctext);

                if (!$stmt->fetch()) {
                    echo "<p>no recently posts</p>";
                }else{
                    $success = true;
                    $i = 0;
                    $data[$i] = $u_cname." : ".$c_ctext;
                    $i+=1;
                     while ($stmt->fetch()) {

                        $data[$i] = $u_cname." : ".$c_ctext;
                        $i+=1;

                     }

                }

                //$mysqli->close();
            }else{
                $message = 'nonodatabase';
            }


            $response = array('success' => $success, 'data' => $data, 'message' => $message);
            echo json_encode($response);


        break;
        case "searchbar":

            $ids='';
            $keyword = $_GET["search_keyword"];
             $query = "SELECT c_title , c_id FROM content WHERE c_title LIKE '%$keyword%'";
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($c_title, $c_id);
                if (!$stmt->fetch()) {
                    $data .= 'N/A';
                }else{
                    $success = true;
                    $i = 0;
                    $data[$i] = $c_title;
                    $ids[$i] = $c_id;
                    $i+=1;
                     while ($stmt->fetch()) {

                        $data[$i] = $c_title;
                        $ids[$i] = $c_id;
                        $i+=1;

                     }

                }

                //$mysqli->close();
            }else{
                $message .= 'nonodatabase';
            }


            $response = array('success' => $success, 'data' => $data, 'ids' => $ids, 'message' => $message);
            echo json_encode($response);
            break;
        case "loadMessage":

            if (empty($_GET["mtime"])) {
                $message = "need time";
            } else {
                $mtime  = $_GET["mtime"];
            }
            $query = "SELECT * FROM message  WHERE m_time >= '$mtime' ORDER BY m_time DESC";
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($users, $m_text, $m_time);

                if (!$stmt->fetch()) {
                    echo "<p>no recently posts</p>";
                    $query2 = "INSERT INTO message VALUES ('$u_id','$u_id'.' login.',now());";
                    mysqli_query($mysqli, $query);
                    $i = 0;
                    $data[$i] = $u_id." : ".$u_id."login.";
                }else{
                    $success = true;
                    $i = 0;
                    $data[$i] = $u_id." : ".$m_text;
                    $i+=1;
                     while ($stmt->fetch()) {

                        $data[$i] = $u_id." : ".$m_text;
                        $i+=1;

                     }

                }

                //$mysqli->close();
            }else{
                $message = 'nonodatabase';
            }


            $response = array('success' => $success, 'data' => $data, 'message' => $message);
            echo json_encode($response);


        break;

         case "notifyUser":

            $postId = $_GET["postId"];


            $query = "SELECT u_id FROM (SELECT distinct u_id FROM comments WHERE c_id = ? union SELECT distinct u_id FROM likes WHERE c_id = ?) lusers Where u_id != ?";
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param("sss", $postId, $postId, $u_id);
                $stmt->execute();
                $stmt->bind_result($users);
                if (!$stmt->fetch()) {
                  //  $success = true;

                    $message .= $postId;
                    $message .= $u_id;
                    $message .= ' no results!';
                    echo "<p>no recently posts</p>";
                }else{
                    $success = true;
                    $i = 0;
                    $data[$i] = $users;
                    $i+=1;
                     while ($stmt->fetch()) {

                        $data[$i] =$users;
                        $i+=1;

                     }

                }

                //$mysqli->close();
            }else{
                $message .= 'nonodatabase';
            }

            $response = array('success' => $success, 'data' => $data, 'message' => $message);
            echo json_encode($response);


        break;

        default:
            $message="unknown action";
    }









}else{
    echo('POST required');
}
?>