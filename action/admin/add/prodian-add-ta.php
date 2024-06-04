<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['add']))
    {  
        move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
        $location=$_FILES["image"]["name"];
        $serial = $_POST['serialnum'];
        $brand = $_POST['brand'];
        $assetname = $_POST['assetname'];
        $department = $_POST['department'];
        $date = $_POST['dateofused']; 

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO inventory_ta(a_image, serial_num, brand, a_name, dept, date_used) 
        VALUES ('$location', '$serial', '$brand', '$assetname','$department','$date')";

        $conn->exec($sql);
        echo "<script>
        alert('Add Successfully');
        window.location.href='../../../E3/admin/prodian-inventory-ta.php';
        </script>";
    // }
    }
    // }
?>   