<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO mro_repaired SELECT * FROM mro_reparation WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM mro_reparation WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['accept'] = 1;
        header("Location:../../../E3/mro/prodian-mro-repair.php");
    } else {
        header("Location:../../../E3/mro/prodian-mro-repair.php");
    }
?>
