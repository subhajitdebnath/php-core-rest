<?php
    include_once './config/database.php';
    include_once './config/auth-guard.php';

    $query = "SELECT * FROM `users`";
    $qry_exec = mysqli_query($con, $query);

    $num = mysqli_num_rows($qry_exec);

    $users = [];
    while($row = mysqli_fetch_array($qry_exec)) {
        $users[] = array('name' => $row['name'], 'email' => $row['email']);
    }


    echo json_encode(
        array(
            "status" => "success",
            "data" => $users
        )
    );
?>