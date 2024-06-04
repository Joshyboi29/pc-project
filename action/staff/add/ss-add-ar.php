<?php
    include ('../../conn/connection.php');

    if(isset($_POST['add']))
    {  
        $asset = $_POST['assetname'];
        $qty = $_POST['qty'];
        $date = $_POST['dateofreq']; 

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO arm_ar (req_name, req_qty, req_date) 
        VALUES ('$asset','$qty','$date')";

        $conn->exec($sql);
        echo "<script>alert('Successfully Added!!!')</script>";
        header("Location: ../../ss-ar.php");
    // }
    }
    // }
?>   