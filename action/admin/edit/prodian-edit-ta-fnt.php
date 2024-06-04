<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['update'])){

    $get_id=$_REQUEST['id'];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
    $location=$_FILES["image"]["name"];
    $assetname = $_POST['assetname'];
    $department = $_POST['department'];
    $date = $_POST['dateofused']; 
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ((!($_FILES['image']['name']))) /* If there Is No file Selected*/ {
        $sql = "UPDATE inventory_ta_fnt SET a_name = '$assetname', 
        dept ='$department', date_used = '$date' WHERE id = '$get_id'";
    } else{
        $sql = "UPDATE inventory_ta_fnt SET a_image= '$location', a_name = '$assetname', dept ='$department', 
        date_used = '$date' WHERE id = '$get_id'";
    }
    
    $conn->exec($sql);
    echo "<script>
    alert('Updated Successfully');
    window.location.href='../../../E3/admin/prodian-inventory-ta-fnt.php';
    </script>";
    // }
    }
    // }
?>