<?php
    include_once './config/database.php';
    include_once './config/auth-guard.php';

    $data = json_decode(file_get_contents("php://input"));

    
    $currentTime = date('Y-m-d H:i:s');

    // print_r($data);die();

    $userId = $data->userId;
    $postId = $data->postId;
    $content = $data->content;

    $qry = "INSERT INTO `comments` VALUES ('', ".$userId.", ".$postId.", '".$content."', ".$userId.", '".$currentTime."', 'active')";
    $qry_exec = mysqli_query($con, $qry);

    if($qry_exec){
        echo json_encode(array("status"=> "success", "message" => "Comment Created"));
    } else{
        echo json_encode(array("status"=> "error", "message" => "Unable to create comment."));
    }
?>