<?php
include ('../../../conn/connection.php');

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $stmt = $conn->prepare("DELETE FROM inventory_ta_blg WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if($stmt->execute()){
        echo "<script>
        alert('Record deleted successfully');
        window.location.href='../../../E3/admin/prodian-inventory-ta-blg.php';
        </script>";
    } else {
        echo "<script>
        alert('Error deleting record: " . $stmt->error . "');
        window.location.href='../../../E3/admin/prodian-inventory-ta-blg.php';
        </script>";
    }
}
?>