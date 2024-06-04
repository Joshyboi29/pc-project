<?php
    include('../../../conn/connection.php');

    if(isset($_POST['submit']))
    {  
        $aname = $_POST['aname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $pos = $_POST['position'];
        $dept = $_POST['dept'];
        $cname = $_POST['cname'];
        $cpos = $_POST['cpos'];
        $aissue = $_POST['aissue'];
        $id = $_POST['id'];

        // Insert the record into "mro_reparation" using prepared statements
        $stmt = $conn->prepare("INSERT INTO mro_reparation (a_name, fname, lname, position, dept, cname, cpos, aissue) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$aname, $fname, $lname, $pos, $dept, $cname, $cpos, $aissue]);

        // Delete the record from "mro_checkup_done" using prepared statements
        $stmt = $conn->prepare("DELETE FROM mro_checkup_done WHERE id = ?");
        $stmt->execute([$id]);

        // Set the session variable and redirect the user to the appropriate page
        session_start();
        $_SESSION['request'] = 1;
        header("Location:../../../E3/mro/prodian-mro-checkup-done.php");
    }
?>
