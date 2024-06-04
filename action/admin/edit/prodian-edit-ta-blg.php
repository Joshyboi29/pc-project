<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['update'])){

    $get_id=$_REQUEST['id'];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
    $location=$_FILES["image"]["name"];
    $blgname = $_POST['blgname'];
    $address = $_POST['address'];
    $date = $_POST['dateofconst']; 
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ((!($_FILES['image']['name']))) /* If there Is No file Selected*/ {
        $sql = "UPDATE inventory_ta_blg SET blg_name = '$blgname', 
        address ='$address', date_const = '$date' WHERE id = '$get_id'";
    } else{
        $sql = "UPDATE inventory_ta_blg SET a_image= '$location', blg_name = '$blgname', 
        address ='$address', date_const = '$date' WHERE id = '$get_id'";
    }
    
    $conn->exec($sql);
    echo "<script>
    alert('Updated Successfully');
    window.location.href='../../../E3/admin/prodian-inventory-ta-blg.php';
    </script>";
    // }
    }
    // }
?>