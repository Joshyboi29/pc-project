<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO arm_req_rej SELECT * FROM arm_req_ssa WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM arm_req_ssa WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['reject'] = 1;
        header("Location:../../../E3/admin/prodian-arm-req-ssa.php");
    } else {
        header("Location:../../../E3/admin/prodian-arm-req-ssa.php");
    }
?>
