<?php
include ('../../conn/connection.php');

$id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO arm_req_rec_oth_done SELECT * FROM arm_req_rec_oth WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM arm_req_rec_oth WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['approved'] = 1;
        header("Location:../../log-ra.php");
    } else {
        header("Location:../../log-ra.php");
    }
?>