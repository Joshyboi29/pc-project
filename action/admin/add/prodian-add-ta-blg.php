<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['add']))
    {  
        move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
        $location=$_FILES["image"]["name"];
        $blgname = $_POST['building'];
        $address = $_POST['address'];
        $date = $_POST['dateofcons']; 

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO inventory_ta_blg(a_image, blg_name, address, date_const) 
        VALUES ('$location','$blgname','$address','$date')";

        $conn->exec($sql);
        echo "<script>
        alert('Add Successfully');
        window.location.href='../../../E3/admin/prodian-inventory-ta-blg.php';
        </script>";
    // }
    }
    // }
?>   