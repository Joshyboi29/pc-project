<?php
    include ('../../conn/connection.php');

    if(isset($_POST['request']))
    {  
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pos = $_POST['position'];
        $dept = $_POST['dept'];
        $req = $_POST['reqassets'];
        $qty = $_POST['qty'];

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO arm_req_ssa (fname, lname, position, dept, a_name, a_qty) 
        VALUES ('$fname','$lname','$pos','$dept','$req','$qty')";

        $conn->exec($sql);
        session_start();
        $_SESSION['request'] = 1;
        header("Location:../../ss-req-ssa.php");
    }
?>   