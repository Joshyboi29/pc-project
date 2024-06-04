<?php
    include ('../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO prodian_dispatch (fname, lname, position, dept, a_name, a_qty) SELECT fname, lname, position, dept, a_name, a_qty FROM arm_req_rec_oth_dp WHERE id = :id');
    $stmt1->bindParam(':id', $id);
    $stmt2 = $conn->prepare('DELETE FROM arm_req_rec_oth_dp WHERE id = :id');
    $stmt2->bindParam(':id', $id);

    if ($stmt1->execute() && $stmt2->execute()) {
        session_start();
        $_SESSION['confirmation'] = 1;
        header("Location:../../ss-req-ra.php");
        exit();
    } else {
        header("Location:../../ss-req-ra.php");
        exit();
    }
?>
