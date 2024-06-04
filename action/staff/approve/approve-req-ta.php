<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO req_ta SELECT * FROM arm_req_ta WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM arm_req_ta WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['approved'] = 1;
        header("Location:../../../../E3/admin/prodian-arm-req-ta.php");
    } else {
        header("Location:../../../../E3/admin/prodian-arm-req-ta.php");
    }
?>
