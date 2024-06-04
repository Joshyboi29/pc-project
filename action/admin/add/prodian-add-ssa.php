<?php
    include ('../../../conn/connection.php');

    if(isset($_POST['add']))
    {  
        move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/img/prodian/" . $_FILES["image"]["name"]);			
        $location=$_FILES["image"]["name"];
        $supplies = $_POST['assetname'];
        $types = $_POST['types'];
        $quantity = $_POST['qty'];
        $unit = $_POST['unit'];    

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO inventory_ssa(a_image, s_name, category, qty_stocks,unit) 
                VALUES ('$location','$supplies','$types','$quantity','$unit')";
            
        $conn->exec($sql);
        echo "<script>
        alert('Add Successfully');
        window.location.href='../../../E3/admin/prodian-inventory-ssa.php';
        </script>";
    // }
    }
    // }
?>   
