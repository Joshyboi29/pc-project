<?php
    include ('../../../conn/connection.php');

    $id = $_GET['id'];

    $stmt1 = $conn->prepare('INSERT INTO dispatch_vcl_rv (a_image, plate, vbrand, type) 
                             SELECT a_image, plate, vbrand, type FROM dispatch_vcl_vl WHERE id=?');
    $stmt2 = $conn->prepare('DELETE FROM dispatch_vcl_vl WHERE id=?');

    if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
        session_start();
        $_SESSION['request'] = 1;
        header("Location: ../../../E3/dispatch/prodian-dispatch-vl.php");
    } else {
        header("Location: ../../../E3/dispatch/prodian-dispatch-vl.php");
    }
?>
