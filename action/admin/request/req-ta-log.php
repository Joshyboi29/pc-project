<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['submit']))
    {  
        $dept = $_POST['dept'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $branch = $_POST['branch'];
        $pos = $_POST['position'];
        $pname = $_POST['pname'];
        $qty = $_POST['pqty'];
        $desc = $_POST['desc'];
        $cname = $_POST['cname'];

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO arm_req_rec_oth (dept, fname, lname,  position, branch, a_name, a_qty, a_desc, cname) 
        VALUES ('$dept','$fname','$lname','$pos','$branch','$pname','$qty','$desc','$cname')";

        $conn->exec($sql);

        // delete previous data with same fname and lname
        $deleteSql = "DELETE FROM req_ta WHERE fname='$fname' AND lname='$lname' AND a_name='$pname'";
        $conn->exec($deleteSql);

        session_start();
        $_SESSION['request'] = 1;
        header("Location:../../../E3/admin/prodian-arm-req.php");
    }
?>
