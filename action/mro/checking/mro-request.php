<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO mro_checkup SELECT * FROM mro_repair_request WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM mro_repair_request WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['accept'] = 1;
        header("Location:../../../E3/mro/prodian-mro-request.php");
    } else {
        header("Location:../../../E3/mro/prodian-mro-request.php");
    }
?>
