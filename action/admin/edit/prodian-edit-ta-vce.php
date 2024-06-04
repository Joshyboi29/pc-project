<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['update'])){

    $get_id=$_REQUEST['id'];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
    $location=$_FILES["image"]["name"];
    $plate = $_POST['platenum'];
    $ornum = $_POST['ornum'];
    $crnum = $_POST['crnum'];
    $brand = $_POST['brand'];
    $type = $_POST['type']; 
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ((!($_FILES['image']['name']))) /* If there Is No file Selected*/ {
        $sql = "UPDATE inventory_ta_vce SET plate_num = '$plate', or_num = '$ornum', cr_num = '$crnum', 
        b_name ='$brand', vce_type = '$type' WHERE id = '$get_id'";
    } else{
        $sql = "UPDATE inventory_ta_vce SET a_image= '$location', plate_num = '$plate', or_num = '$ornum', cr_num = '$crnum', 
        b_name ='$brand', vce_type = '$type' WHERE id = '$get_id'";
    }
    
    $conn->exec($sql);
    echo "<script>
    alert('Updated Successfully');
    window.location.href='../../../E3/admin/prodian-inventory-ta-vce.php';
    </script>";
    // }
    }
    // }
?>