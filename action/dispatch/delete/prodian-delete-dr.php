<?php
include ('../../../conn/connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM dispatch_dr WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if($stmt->rowCount() == 1){
        session_start();
        $_SESSION['delete'] = 1;
        header("Location:../../../E3/dispatch/prodian-dispatch-dr.php");
    }
}
?>