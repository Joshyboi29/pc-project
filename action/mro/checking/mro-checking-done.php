<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO mro_checkup_done SELECT * FROM mro_checkup WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM mro_checkup WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        header("Location:../../../E3/mro/prodian-mro-checkup-pen.php");
    } else {
        echo "error";
    }
?>
