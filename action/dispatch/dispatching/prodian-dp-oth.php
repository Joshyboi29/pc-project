<?php
    include('../../../conn/connection.php');
    
    if(isset($_POST['dispatch'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pos = $_POST['position'];
        $dept = $_POST['dept'];
        $req = $_POST['reqassets'];
        $qty = $_POST['qty'];
        $branch = $_POST['branch'];
        $driver = $_POST['driver'];
        $vcl = $_POST['vehicle'];
        $branch = $_POST['branch'];

        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            
            $stmt1 = $conn->prepare("INSERT INTO dispatch_dp_oth_done (fname, lname, position, dept, a_name, a_qty, driver, vcl, branch) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->execute([$fname, $lname, $pos, $dept, $req, $qty, $driver, $vcl, $branch]);

            $stmt2 = $conn->prepare("DELETE FROM dispatch_dp_oth WHERE fname=? AND lname=? AND position=? AND dept=? AND a_name=?");
            $stmt2->execute([$fname, $lname, $pos, $dept, $req]);


            $conn->commit();
            session_start();
            $_SESSION['dispatch'] = 1;
            header("Location:../../../E3/dispatch/prodian-dispatch-rl-oth.php");
        } catch (PDOException $e) {
            $conn->rollBack();
            exit();
        }
    }
?>
