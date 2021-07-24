<?php
    include_once './config/database.php';
    include_once './config/auth-guard.php';

    $data = json_decode(file_get_contents("php://input"));

    $fromUserId = $data->fromUserId;
    $toUserId = $data->toUserId;

    // getting sender and receiver data
    $sender = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = ".$fromUserId);
    $sender = mysqli_fetch_array($sender);

    $receiver = mysqli_query($con, "SELECT * FROM `users` WHERE `id` = ".$toUserId);
    $receiver = mysqli_fetch_array($receiver);

    $qry = "
        SELECT *
        FROM (SELECT 
                * 
            FROM 
                `messages` 
            WHERE 
            `fromUserId` = ".$fromUserId." AND 
            `toUserId` = ".$toUserId." UNION 
            SELECT 
                * 
            FROM 
                `messages` 
            WHERE 
            `fromUserId` = ".$toUserId." AND 
            `toUserId` = ".$fromUserId.") a
        ORDER BY `id` ASC"
        ;
    $q1 = mysqli_query($con, $qry);

    $messages = [];
    while($msg = mysqli_fetch_array($q1)) {
        $messages[] = array(
            'id' => $msg['id'],
            'fromUserId' => $msg['fromUserId'],
            'toUserId' => $msg['toUserId'],
            'text' => $msg['text'],
            'createdAt' => $msg['createdAt'],
            'createdBy' => $msg['createdBy']
        );
    }

    echo json_encode(array("status"=> "success", "messages" => $messages, "sender" => $sender, "receiver" => $receiver));
?>