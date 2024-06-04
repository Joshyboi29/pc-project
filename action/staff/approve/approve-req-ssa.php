<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO dispatch_dp_sa SELECT * FROM arm_req_ssa WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM arm_req_ssa WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['approved'] = 1;
        header("Location:../../../E3/staff/prodian-staff-req-ssa.php");
    } else {
        header("Location:../../../E3/staff/prodian-staff-req-ssa.php");
    }
?>
