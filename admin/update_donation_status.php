<?php

require_once '../php/config.php';

if (isset($_GET['status'])){
    $status1 = $_GET['status']; // decleare variable

    $sql = "SELECT * FROM donation WHERE donet_id='$status1'"; // select all students

    $result = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_object($result)){
        $status_var = $row->status;

        if ($status_var == '0'){
            $status_state = 1;
        }else{
            $status_state = 0;
        }
        $update = "UPDATE donation SET status = '$status_state' WHERE donet_id = '$status1'";

        $res = mysqli_query($connect, $update);

        if ($res){
            header('Location: approve_donation_post.php');
        }else{
            echo  mysqli_error($res);
        }
    }
}

?>