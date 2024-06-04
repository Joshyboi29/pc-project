<?php
    include ('../../conn/connection.php');

    if(isset($_POST['submit']))
    {  
        $dept = $_POST['department'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pos = $_POST['position'];
        $branch = $_POST['branch'];
        $aname = $_POST['aname'];
        $category = $_POST['category'];
        $qty = $_POST['qty'];
        $date = $_POST['date'];
        $desc = $_POST['desc'];

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO arm_req_ta (dept, fname, lname, email, position, branch, a_name, a_category, a_qty, date, a_desc) 
        VALUES ('$dept','$fname','$lname','$email','$pos','$branch','$aname','$category','$qty','$date','$desc')";

        $conn->exec($sql);
        session_start();
        $_SESSION['request'] = 1;
        header("Location:../../ss-req-ta.php");
    // }
    }
    // }
?>   