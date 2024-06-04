<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['update'])){

    $get_id=$_REQUEST['id'];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
    $location=$_FILES["image"]["name"];
    $serial = $_POST['serialnum'];
    $brand = $_POST['brand'];
    $assetname = $_POST['assetname'];
    $department = $_POST['department'];
    $date = $_POST['dateofused']; 
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ((!($_FILES['image']['name']))) /* If there Is No file Selected*/ {
        $sql = "UPDATE inventory_ta_eq SET serial_num = '$serial', brand = '$brand', a_name = '$assetname', 
        dept ='$department', date_used = '$date' WHERE id = '$get_id'";
    } else{
        $sql = "UPDATE inventory_ta_eq SET a_image= '$location', serial_num = '$serial', brand = '$brand', a_name = '$assetname', 
        dept ='$department', date_used = '$date' WHERE id = '$get_id'";
    }

    if($conn->exec($sql)){
        session_start();
        $_SESSION['update'] = 1;
        header("Location:../../../E3/admin/prodian-inventory-ta-eq.php");

    } else {
        session_start();
        $_SESSION['error'] = 1;
        header("Location:../../../E3/admin/prodian-inventory-ta-eq.php");
    }        
    exit();
    }
?>