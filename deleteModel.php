<?php
session_start();
include 'includes/connectionSet.php';
include 'includes/header.php';

if(isset($_SESSION['admin'])){
    $role = $_SESSION['admin'];
}

if($role = 0){
    header('location: modelDisplay.php');
}

if(isset($_GET['product_id']) && is_numeric($_GET['product_id'])){
    
    $id=$_GET['product_id'];
    $sql = "DELETE from products WHERE product_id =?";

    $stmt = $conn->prepare($sql);
    $stmt-> bind_param("i", $id);
    $stmt->execute();
    echo"<p style='color:red'><strong>Model deleted with ID:". $id."</strong></p>";
} else{
    echo "Model not found with ID: ".$id;
}
$conn->close();
?>

<div class="backDashboard">
    <a href="adminDashboard.php">Back to Dashboard</a>
</div>

<?php
include 'includes/footer.php';