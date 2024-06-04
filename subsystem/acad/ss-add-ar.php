<?php
    include ('conn/connection.php');

    if(isset($_POST['request']))
    {  
        $name = $_POST['name'];
        $position = $_POST['position'];
        $dept = $_POST['department'];
        $asset = $_POST['assetname'];
        $qty = $_POST['qty'];
        $date = $_POST['dateofreq'];

        $sql = "INSERT INTO arm_ar(r_name, position, department, req_name, req_qty, req_date) 
                VALUES ('$name','$position','$dept','$asset','$qty','$date')";
        if (mysqli_query($conn, $sql))
        {
            echo '<script>
            window.location.href = "ss-ar.php";
            alert("Successfully Insert.")
            </script>';
        }
        else
        {
        echo "Error: " . $sql . " " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>   