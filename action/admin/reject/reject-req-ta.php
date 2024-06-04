<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO arm_req_rej SELECT id, fname, lname, position, dept, a_name, a_qty FROM arm_req_ta WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM arm_req_ta WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['reject'] = 1;
        header("Location:../../../E3/admin/prodian-arm-req-ta.php");
    } else {
        header("Location:../../../E3/admin/prodian-arm-req-ta.php");
    }
?>
