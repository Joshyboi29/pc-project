<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['update'])){

    $get_id=$_REQUEST['id'];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
    $location=$_FILES["image"]["name"];
    $supplies = $_POST['assetname'];
    $types = $_POST['types'];
    $quantity = $_POST['qty'];
    $unit = $_POST['unit']; 
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ((!($_FILES['image']['name']))) /* If there Is No file Selected*/ {
        $sql = "UPDATE inventory_ssa SET a_name = '$supplies', category = '$types', a_qty = '$quantity', 
        unit ='$unit' WHERE id = '$get_id'";
    } else{
        $sql = "UPDATE inventory_ssa SET a_image= '$location', a_name = '$supplies', category = '$types', a_qty = '$quantity', 
        unit ='$unit' WHERE id = '$get_id'";
    }
    
    if($conn->exec($sql)){
        session_start();
        $_SESSION['update'] = 1;
        header("Location:../../../E3/admin/prodian-inventory-ssa.php");

    } else {
        session_start();
        $_SESSION['error'] = 1;
        header("Location:../../../E3/admin/prodian-inventory-ssa.php");
    }        
    exit();
    }
?>