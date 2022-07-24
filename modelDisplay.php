<?php session_start();

include 'includes/connectionSet.php';
include 'includes/header.php';

if(isset($_SESSION['admin'])){
    $role = $_SESSION['admin'];
}
if(!isset($_SESSION['admin'])){
    header ('Location: index.php');
}

$limit = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$sql = "SELECT * FROM products LIMIT $page, $limit";
$result = $conn->query($sql);
if($result === false){
    echo $conn->error();
} else {
    $models = $result->fetch_all(MYSQLI_ASSOC);
}

$result1 = $conn->query("SELECT count(product_id) AS id FROM products");
$modelCount = $result1->fetch_all(MYSQLI_ASSOC);
$total = $modelCount[0]['id'];
$pages = ceil($total / $limit);

$Previous = $page - 3;
$Next = $page + 3;

?>

<?php
if(empty($models)): ?>
    <p>No models found</p>
<?php else: ?>
    <table>
    <tr>
        <?php foreach($models as $model):?>
            <td class="card">
            <img src=<?="images/".$model['product_image']?> style="max-height:300px; ">
                <h1><?=$model['product_name']?></h1>
                <p class="price"> $ <?=number_format($model['product_price'])?></p>
                <p><?=$model['product_description']?></p>
                <p><button>Add to Cart</button></p>
            </td>
            <?php endforeach;?>
        </tr>
    </table>
    <?php endif; ?>
    <div class="pagContainer">
        <div class="downMenu" >
            <div class="pagination">
                <nav aria-label="Page navigation"  >
                <a class="<?= $page <= 0 ? 'disabled': ''; ?>" href="modelDisplay.php?page=<?= $Previous; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Previous</span>
                </a>
                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <a href="modelDisplay.php?page=<?= $i-1; ?>"><?= $i; ?></a>
                    <?php endfor; ?>
                    <a class="<?= $page >= $pages ? 'disabled': ''; ?>" href="modelDisplay.php?page=<?= $Next; ?>" aria-label="Next">
                    <span aria-hidden="true">Next &raquo;</span>
                </a>
            </nav>
        </div>
    </div>
        
<?php
    include 'includes/footer.php';