<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO mro_repair_request SELECT * FROM prodian_mro WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM prodian_mro WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['approved'] = 1;
        header("Location:../../../E3/admin/prodian-mro.php");
    } else {
        header("Location:../../../E3/admin/prodian-mro.php");
    }
?>
