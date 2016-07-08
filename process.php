<?php
include("mysql_connect.php");
session_start();
if (isset($_SESSION['u_id'])) $u_id = $_SESSION['u_id']; else $u_id='Guest';

    $function = $_POST['function'];

    $log = array();

    switch($function) {

    	 case('getState'):
        	 if(file_exists('chat.txt')){
               $lines = file('chat.txt');
        	 }
             $log['state'] = count($lines);

             if ($stmt = $mysqli->prepare("SELECT m_time FROM message ORDER BY m_time DESC LIMIT 1")) {
                $stmt->execute();
                $stmt->bind_result($m_time);
                $stmt->fetch();
                $stmt->close();
                $log['m_time'] = $m_time;
            }

        	 break;
        case('getUsers'):
            // return users with u_pollDate> currentTime - 5 sec

        break;
    	 case('update'):

            // update current user's u_pollDate field as current time


            $m_time = $_POST['m_time'];

        	$state = $_POST['state'];
        	if(file_exists('chat.txt')){
        	   $lines = file('chat.txt');
        	 }
        	 $count =  count($lines);
        	 if($state == $count){
        		 $log['state'] = $state;
        		 $log['text'] = false;

        		 }
        		 else{
        			 $text= array();
        			 $log['state'] = $state + count($lines) - $state;
        			 foreach ($lines as $line_num => $line)
                       {
        				   if($line_num >= $state){
                         $text[] =  $line = str_replace("\n", "", $line);
        				   }

                        }
        			 $log['text'] = $text;
        		 }

            if ($stmt = $mysqli->prepare("SELECT u_id, m_text, m_time FROM message WHERE m_time>? ORDER BY m_time ASC")) {
                $stmt->bind_param("s", $m_time);
                $result = $stmt->execute();
                $stmt->bind_result($_u_id, $_m_text, $_m_time);
                if (!$stmt->fetch()) {
                    //echo "<p>no recently posts</p>";
                }else{
                    //$success = true;
                    $i = 0;
                    $data=array();
                    //$data[] = (object) array('u_id' => $_u_id, 'm_text' => $_m_text, 'm_time' => $_m_time);
                    do {
                        $data[] = (object) array('u_id' => $_u_id, 'm_text' => $_m_text, 'm_time' => $_m_time);
                    } while ($stmt->fetch());

                     $log['message'] = $data;

                }
                $stmt->close();

            }

             break;

    	 case('send'):
		  //$nickname = htmlentities(strip_tags($_POST['nickname']));
			 $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			  $message = htmlentities(strip_tags($_POST['message']));
		 if(($message) != "\n"){

			 if(preg_match($reg_exUrl, $message, $url)) {
       			$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
				}

            $query = "INSERT INTO message (u_id, m_text) VALUES ('".$u_id."','".$message."');";
            if (mysqli_query($mysqli, $query)) {
                //
            }
            //fwrite(fopen('chat.txt', 'a'), "<span>". $u_id . "</span>" . $message = str_replace("\n", " ", $message) . "\n");
            //fwrite(fopen('chat.txt', 'a'), "<span>". $one . "</span>" . $two . " - ".$three."\n");

		 }
        	 break;

    }

    echo json_encode($log);

?>