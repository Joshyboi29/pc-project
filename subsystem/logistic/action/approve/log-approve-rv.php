<?php
include ('../conn/connection.php');

$id = $_GET['id'];

$stmt1 = $conn->prepare('INSERT INTO dispatch_vcl_bv (a_image, plate, vbrand, type) 
                        SELECT a_image, plate, vbrand, type FROM dispatch_vcl_rv WHERE id=?');
$stmt2 = $conn->prepare('DELETE FROM dispatch_vcl_rv WHERE id=?');
$stmt3 = $conn->prepare('DELETE FROM dispatch_vcl_vl WHERE id=?');

if ($stmt1->execute([$id]) && $stmt2->execute([$id]) && $stmt3->execute([$id])) {
    $new_id = $conn->lastInsertId();
    session_start();
    $_SESSION['approved'] = 1;
    $_SESSION['new_id'] = $new_id;
    header("Location:../logistic/approve/log-approve-vr.php");
} else {
    header("Location:../logistic/approve/log-approve-vr.php");
}

?>
