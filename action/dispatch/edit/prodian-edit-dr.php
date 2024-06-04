<?php
include ('../../../conn/connection.php');

if(isset($_POST['update'])){
    $get_id = $_REQUEST['id'];
    $lid = $_POST['lid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $email = $_POST['email'];    
    $cp = $_POST['cp'];
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE dispatch_dr SET l_id = ?, fname = ?, lname = ?, age = ?, email = ?, cp = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$lid, $fname, $lname, $age, $email, $cp, $get_id]);

    if($stmt->rowCount() > 0){
        session_start();
        $_SESSION['update'] = 1;
        header("Location: ../../../E3/dispatch/prodian-dispatch-dr.php");
        exit();
    } else {
        session_start();
        $_SESSION['error'] = 1;
        header("Location: ../../../E3/dispatch/prodian-dispatch-dr.php");
        exit();
    }
}
?>
