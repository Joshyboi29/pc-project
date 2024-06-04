<?php
    include('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO arm_req_rec_oth_dp (fname, lname, position, dept, a_name, a_qty) SELECT fname, lname, position, dept, a_name, a_qty FROM dispatch_dp_oth_done WHERE id = :id');
    $stmt1->bindParam(':id', $id);
    $stmt2 = $conn->prepare('DELETE FROM dispatch_dp_oth_done WHERE id = :id');
    $stmt2->bindParam(':id', $id);

    if ($stmt1->execute() && $stmt2->execute()) {
        session_start();
        $_SESSION['delivered'] = 1;
        header("Location: ../../../E3/dispatch/prodian-dispatch-dp-oth.php");
        exit();
    } else {
        header("Location: ../../../E3/dispatch/prodian-dispatch-dp-oth.php");
        exit();
    }
?>
