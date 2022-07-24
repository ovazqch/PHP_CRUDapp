<?php
session_start();
include 'includes/connectionSet.php';
include 'includes/header.php';

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if(isset($_SESSION['admin'])){
    $role = $_SESSION['admin'];
}

if($role == 0){
    header('location: modelDisplay.php');
}

if(isset($_GET['product_id']) && is_numeric($_GET['product_id'])){
    $id = $_GET['product_id'];

    $query = "SELECT * FROM products WHERE product_id = $id";
    $result = mysqli_query($conn , $query);

    if($result === false){
        echo "no model";

    } else {
        if(mysqli_num_rows($result) > 0){
        
            while($row = mysqli_fetch_array($result)){
                
                    $modelName  = $row['product_name'];
                    $modelDescription = $row['product_description'];
                    $modelPrice = $row['product_price'];
                    $modelAvailability = $row['product_availability'];
                    $modelImage = $row['product_image'];
                }
            }
    }
}

if(isset($_POST['update'])){

$mName = $_POST['modelName'];
$mDescription = $_POST['modelDescription'];
$mPrice = $_POST['modelPrice'];
$mAvailability = $_POST['modelAvailability'];

try{
    if(empty($_FILES)){
        throw new Exception('Invalid Upload');
        return;
    }

    switch ($_FILES['modelImage']['error']){
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_INI_SIZE:
            throw new Exception('File is too large, please upload smaller image');
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception('No file to upload');
            break;
        default:
            throw new Exception('There is an error');
            break;
    }

    $filesize = 2000000;
    if($_FILES['modelImage']['size'] > $filesize){
        throw new Exception('File is too large');
        return;
    }

    $file_types = ['image/gif', 'image/png', 'image/jpeg'];
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($fileinfo, $_FILES['modelImage']['tmp_name']);

    if(!in_array($mime_type, $file_types)){
        throw new Exception('Invalid file type, please upload images');
        return;
    }

    $pathinfo = pathinfo($_FILES['modelImage']['name']);
    $base = $pathinfo['filename'];
    $base = mb_substr($base, 0, 200);
    $filename = $base.".".$pathinfo['extension'];
    $destination = "images/$filename";

    if(file_exists($destination)){
        echo "File Already Exist in the folder";
    } else {
        if(move_uploaded_file($_FILES['modelImage']['tmp_name'], $destination)){
            echo "File Uploaded successfully";
        }else{
            throw new Exception('Unable to move the uploaded file');
        }
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$mImage_name = $_FILES['modelImage']['name'];
$mImage = $_FILES['modelImage']['tmp_name'];
$location = "images/" . $mImage_name;

$sql = "UPDATE products SET product_name=?, product_description=?, product_price=?, product_availability=?, product_image=? WHERE product_id = $id";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo $conn->mysqli_error();
    } else {
        if($mImage_name == null){
            $mImage_name = $modelImage;
            $stmt->bind_param("ssdis", $mName, $mDescription, $mPrice, $mAvailability, $mImage_name);
            $stmt->execute();
            echo "<p style='color:green'><strong>Model successfully edited ID:".$id."</strong></p>";
        } else{
            $stmt->bind_param("ssdis", $mName, $mDescription, $mPrice, $mAvailability, $mImage_name);
            move_uploaded_file($mImage_name, $location);
            $stmt->execute();
            echo "<p style='color:green'><strong>Model successfully edited ID:".$id."</strong></p>";
        }
    }
}
?>
<div class="container">
    <h1> Edit Model </h1>
    <div class="row">
        <form action=<?=$_SERVER['PHP_SELF']?> method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <img id="imgDisplay" src= "<?="images/".$modelImage?>" alt="" >
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="modelName" class="form-control" placeholder="" value="<?php echo $modelName ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="modelDescription" rows="4" cols ="50"><?php echo $modelDescription ?> </textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="text" name="modelPrice" class="form-control" placeholder="" value="<?php echo $modelPrice ?>"></td>
                </tr>
                <tr>
                    <td>Avaliability</td>
                    <td><input type="text" name="modelAvailability" class="form-control" placeholder="" value="<?php echo $modelAvailability ?>"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="modelImage" class="btn btn-primary" placeholder="" value="<?php echo $image ?>"></td>
                </tr>
            </table>
            <input type="submit" class="btn btn-success" value="Update Model" name="update">
        </form>
    </div>
    <div class="backDashboard">
        <a href="adminDashboard.php">Back to Dashboard</a>
    </div>
</div>
</div>
        



<?php
include 'includes/footer.php';