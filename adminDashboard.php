<?php session_start();

include 'includes/connectionSet.php';
include 'includes/header.php';

if(isset($_SESSION['admin'])){
    $role = $_SESSION['admin'];
}
if($role == 0){
    header ('location: index.php');
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
if($result === false){
    echo $conn->error();
} else {
    $models = $result->fetch_all(MYSQLI_ASSOC);
}


setlocale(LC_MONETARY,"en_CA");
?>
<div>
<div class="addModel">
    <a href="newModel.php">Add new model</a>
</div>
</div>


<?php if(empty($models)): ?>
    <p>No books found</p>
<?php else: ?>
    <div class="tableContainer">
        <table>
            <th>Model Id</th>
            <th>Model Name</th>
            <th>Model Description</th>
            <th>Model Price</th>
            <th>Model Availability</th>
            <th>Model Image</th>
            <th>Edit</th>
            <th>Delete</th>
            <?php foreach($models as $model):?>
                <tr>
                    <td><?=$model['product_id']?></td>
                    <td><?=$model['product_name']?></td>
                    <td><?=$model['product_description']?></td>
                    <td>$<?=number_format($model['product_price'])?></td>
                    <td><?=$model['product_availability']?></td>
                    <td style="width:250px; height:250px;"><img src=<?="images/".$model['product_image']?> style="max-height:100%; max-width:100%"></td>
                    <td><a href="editModel.php?product_id=<?=$model['product_id']?>" class="editBtn">Edit</a></td>
                    <td><a href="deleteModel.php?product_id=<?=$model['product_id']?>" class="deleteBtn">Delete</a></td>
                </tr>
            <?php endforeach;?>
        </table>
            <?php endif; ?>
    </div>

<?php
        include 'includes/footer.php';