<?php
    include('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO dispatch_dp_oth (dept, fname, lname, email, branch, position, a_name, a_qty, date, a_desc, cname) 
                             SELECT dept, fname, lname, email, branch, position, a_name, a_qty, date, a_desc, cname FROM arm_req_rec_oth_done WHERE id = :id');
    $stmt1->bindParam(':id', $id);
    $stmt2 = $conn->prepare('DELETE FROM arm_req_rec_oth_done WHERE id = :id');
    $stmt2->bindParam(':id', $id);

    if ($stmt1->execute() && $stmt2->execute()) {
        session_start();
        $_SESSION['dispatch'] = 1;
        header("Location: ../../../E3/admin/prodian-arm-rec.php");
        exit();
    } else {
        header("Location: ../../../E3/admin/prodian-arm-rec.php");
        exit();
    }
?>
