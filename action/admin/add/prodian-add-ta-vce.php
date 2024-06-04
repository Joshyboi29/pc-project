<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['add']))
    {  
        move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
        $location=$_FILES["image"]["name"];
        $plate = $_POST['platenum'];
        $ornum = $_POST['ornum'];
        $crnum = $_POST['crnum'];
        $brand = $_POST['brand'];
        $type = $_POST['type']; 

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO inventory_ta_vce(a_image, plate_num, or_num, cr_num, b_name, vce_type) 
        VALUES ('$location','$plate','$ornum','$crnum','$brand','$type')";

        $conn->exec($sql);
        echo "<script>
        alert('Add Successfully');
        window.location.href='../../../E3/admin/prodian-inventory-ta-vce.php';
        </script>";
    // }
    }
    // }
?>   