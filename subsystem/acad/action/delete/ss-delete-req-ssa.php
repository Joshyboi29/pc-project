<?php
    include ('../../conn/connection.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM arm_req_rej WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            session_start();
            $_SESSION['delete'] = 1;
            header("Location:../../ss-rl.php");
        }
    }
?>