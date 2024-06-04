<?php
include ('../../../conn/connection.php');

if(isset($_POST['add']))
{  
    $lid = $_POST['lid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $email = $_POST['email'];    
    $cp = $_POST['cp'];

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO dispatch_dr(l_id, fname, lname, age, email, cp) 
            VALUES ('$lid','$fname','$lname','$age','$email','$cp')";
        
    $conn->exec($sql);
    session_start();
    $_SESSION['add'] = 1;
    header("Location: ../../../E3/dispatch/prodian-dispatch-dr.php");
// }
}
// }
?>   
