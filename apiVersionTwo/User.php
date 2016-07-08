<?php

$message = '';
$success = false;
if (isset($_GET['u_id'])){

    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            $success = true;
            $message = 'We will return object user '. $_GET['u_id'];
        break;
        case "PUT":
            $success = true;
            $message = 'We will update object user '. $_GET['u_id'];
        break;
        case "DELETE":
            $success = true;
            $message = 'We will delete object user '. $_GET['u_id'];
        break;
    }
}else{
    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            $success = true;
            $message = 'We will return list of users';
        break;
        case "POST":
            $success = true;
            $message = 'We will add new user';
        break;
    }
}

$response = array('success' => $success, 'response' => $data, 'message' => $message);
    echo json_encode($response);

?>