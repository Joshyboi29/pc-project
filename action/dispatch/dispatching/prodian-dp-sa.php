<?php
    include('../../../conn/connection.php');
    
    if(isset($_POST['dispatch'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pos = $_POST['position'];
        $dept = $_POST['dept'];
        $req = $_POST['reqassets'];
        $qty = $_POST['qty'];

        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            
            // Insert data into dispatch_dp table
            $stmt1 = $conn->prepare("INSERT INTO dispatch_dp_sa_done (fname, lname, position, dept, a_name, a_qty) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt1->execute([$fname, $lname, $pos, $dept, $req, $qty]);

            // Delete corresponding row from dispatch_dp_sa table
            $id = $conn->lastInsertId(); // get ID of inserted row
            $stmt2 = $conn->prepare("DELETE FROM dispatch_dp_sa WHERE fname=? AND lname=? AND a_name=?");
            $stmt2->execute([$fname, $lname, $req]);


            $conn->commit();
            session_start();
            $_SESSION['dispatch'] = 1;
            header("Location:../../../E3/dispatch/prodian-dispatch-rl-sa.php");
        } catch (PDOException $e) {
            $conn->rollBack();
            header("Location:../../../E3/dispatch/prodian-dispatch-rl-sa.php");
            exit();
        }
    }
?>
