<?php
    include ('../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO prodian_mro SELECT * FROM ss_us WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM ss_us WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['request'] = 1;
        header("Location:../../ss-us-eq.php");
    } else {
        header("Location:../../ss-us-eq.php");
    }
?>